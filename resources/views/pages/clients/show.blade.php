@extends('layouts.app')

@section('title')
Clients - {{ $client->name }}
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>

<style>
    /* Kanban board layout */
    .kanban-board {
        display: flex;
        flex-direction: row;
        /* Columns aligned horizontally */
        gap: 16px;
        overflow-x: auto;
        /* Enable horizontal scrolling if needed */
        padding: 10px;
    }

    /* Kanban column styling */
    .kanban-column {
        background-color: #f3f3f3;
        border-radius: 8px;
        padding: 16px;
        width: 300px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Column titles */
    .kanban-column h3 {
        margin-bottom: 16px;
        text-align: center;
        color: #333;
    }

    /* Cards container */
    .kanban-cards {
        min-height: 200px;
        border: 2px dashed #ccc;
        padding: 10px;
        border-radius: 4px;
        background-color: #fafafa;
    }

    /* Card styling */
    .kanban-card {
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 10px;
        color: #fff;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: grab;
        transition: transform 0.2s ease-in-out;
    }

    .kanban-card:hover {
        transform: scale(1.05);
        /* Slightly enlarge on hover */
    }

    /* Visual feedback for drop areas */
    .gu-mirror {
        position: fixed !important;
        z-index: 9999 !important;
        opacity: 0.8;
    }

    .kanban-cards.gu-drop-ready {
        background-color: #f0f8ff;
        /* Light blue when ready to drop */
    }

    /* Sticky Notes Container */
    #sticky-notes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    /* Sticky Note Styling */
    .sticky-note {
        background-color: #fdfd96;
        /* Classic sticky note yellow */
        width: 220px;
        min-height: 150px;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.2);
        font-family: 'Comic Sans MS', sans-serif;
        /* Playful font for sticky notes */
        color: #333;
        position: relative;
        transform: rotate(-2deg);
        /* Slight tilt for a casual look */
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Slight Hover Effect */
    .sticky-note:hover {
        transform: rotate(0deg) scale(1.05);
        /* Straighten and enlarge slightly */
        box-shadow: 6px 6px 8px rgba(0, 0, 0, 0.3);
    }

    /* Sticky Note Title */
    .sticky-note h5 {
        font-size: 16px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;
        color: #555;
    }

    /* Sticky Note Text */
    .sticky-note p {
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
        word-wrap: break-word;
    }

    /* Delete Button */
    .sticky-note .delete-note {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 20px;
        color: #d9534f;
        cursor: pointer;
        transition: color 0.2s;
    }

    .sticky-note .delete-note:hover {
        color: #c9302c;
    }

    /* Optional Variants for Colors */
    .sticky-note.blue {
        background-color: #a2d5f2;
        /* Light blue */
    }

    .sticky-note.green {
        background-color: #b2f2a2;
        /* Light green */
    }

    .sticky-note.pink {
        background-color: #f2a2c2;
        /* Light pink */
    }
</style>

<div class="row">
    <div class="col-6">
        <a class="btn btn-primary text-center" href="{{ route('lead.new-lead', $client)}}">
            Add Lead
        </a>
        <a class="btn btn-primary text-center" href="{{ route('edit-client', $client) }}">
            Edit Client
        </a>
        @role('Admin')
        <a class="btn btn-primary text-center" href="javascript:void(0)">
            Add Representative
        </a>
        @endrole
    </div>
</div>
<!-- END Quick Actions -->

<!-- User Info -->
<div class="block block-rounded">
    <div class="block-content text-center">
        <div class="py-4">
            <div class="mb-3">
                <img class="img-avatar" src="assets/media/avatars/avatar13.jpg" alt="">
            </div>
            <h1 class="fs-lg mb-0">
                <span>{{ $client->name }}</span>
            </h1>
            <p class="fs-sm fw-medium text-muted">{{ $client->email }}</p>
            <p class="fs-sm fw-medium text-muted">{{ $client->phone }}</p>
        </div>
    </div>
</div>

<!-- Shopping Cart -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Current Leads</h3>
    </div>

    <div id="kanban-board" class="kanban-board">
        <!-- Columns will be dynamically rendered here -->
    </div>
</div>
<!-- END Shopping Cart -->

<!-- Past Orders -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Past Leads</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-borderless table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">ID</th>
                        <th class="d-none d-md-table-cell text-center">Products</th>
                        <th class="d-none d-sm-table-cell text-center">Submitted</th>
                        <th>Status</th>
                        <th class="d-none d-sm-table-cell text-end">Value</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($client->leads as $lead)
                        <tr>
                            <td class="text-center fs-sm">
                                <a class="fw-semibold" href="be_pages_ecom_order.html">
                                    <strong>{{ $lead->title }}</strong>
                                </a>
                            </td>

                            <td class="d-none d-sm-table-cell text-center fs-sm">{{ $lead->created_at }}</td>
                            <td>
                                <span class="badge bg-success">Delivered</span>
                            </td>
                            <td class="text-end d-none d-sm-table-cell fs-sm">
                                <strong>R{{$lead->revenue}}</strong>
                            </td>

                            <td class="text-end d-none d-sm-table-cell fs-sm">
                                <strong>{{$lead->potential_users}}</strong>
                            </td>
                            <td class="text-center fs-sm">
                                <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.html"
                                    data-bs-toggle="tooltip" title="View">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-bs-toggle="tooltip"
                                    title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Past Orders -->

<!-- Private Notes -->
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h3 class="block-title">Private Notes</h3>
    </div>
    <div class="block-content">
        <p class="alert alert-dark fs-sm">
            <i class="fa fa-fw fa-info me-1"></i> Drop your thought here <3.
        </p>
        <form id="noteForm" onsubmit="return addStickyNote();">
            <div class="mb-4">
                <label class="form-label" for="one-ecom-customer-note">Note</label>
                <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4"
                    placeholder="Update - Set up meeting?"></textarea>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-alt-primary">Add Note</button>
            </div>
        </form>


        <!-- Sticky Notes Section -->
        <div id="sticky-notes-container" class="d-flex flex-wrap gap-3 mt-4">
            <!-- Static sticky note -->
            <div class="sticky-note">
                <h5>Note</h5>
                <p>This is a static note added for demonstration purposes.</p>
                <span class="delete-note" onclick="removeStickyNote(this)">×</span>
            </div>
        </div>
    </div>
</div>
<!-- END Private Notes -->


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const kanbanBoard = document.getElementById('kanban-board');

        // Fetch stages and leads from the server
        fetch('/api/leads')
            .then(response => response.json())
            .then(stages => {
                console.log('Fetched Stages:', stages);
                if (!kanbanBoard) {
                    console.error('Kanban board element not found.');
                    return;
                }
                kanbanBoard.innerHTML = ''; // Clear the board
                renderKanbanBoard(stages, kanbanBoard); // Render the board
                initializeDragula(); // Initialize Dragula after rendering
            })
            .catch(error => console.error('Error fetching stages:', error));
    });

    // Render Kanban board dynamically
// Render Kanban board dynamically
function renderKanbanBoard(stages, kanbanBoard) {
    kanbanBoard.innerHTML = ''; // Clear the board

    stages.forEach(stage => {
        const column = document.createElement('div');
        column.className = 'kanban-column';
        column.id = `stage-${stage.id}`;

        const title = document.createElement('h3');
        title.innerText = stage.title || 'Untitled Stage';
        column.appendChild(title);

        const revenueTotal = document.createElement('div');
        revenueTotal.className = 'kanban-revenue-total';
        revenueTotal.id = `revenue-total-${stage.id}`;
        revenueTotal.innerHTML = `<strong>Total Revenue: </strong>R0`;
        column.appendChild(revenueTotal);

        const cardContainer = document.createElement('div');
        cardContainer.className = 'kanban-cards';
        cardContainer.id = `cards-${stage.id}`;
        column.appendChild(cardContainer);

        let totalRevenue = 0; // Initialize total revenue for this stage

        stage.leads.forEach(lead => {
            const card = document.createElement('div');
            card.className = 'kanban-card';
            card.dataset.id = lead.id;

            // Apply random background color
            const randomColor = getRandomColor();
            card.style.backgroundColor = randomColor;

            card.innerHTML = `<h4>${lead.title}</h4><p>${lead.description}</p><p>R${lead.revenue}</p>`;
            cardContainer.appendChild(card);

            totalRevenue += parseFloat(lead.revenue); // Add lead revenue to the total
        });

        // Update the total revenue for this stage
        revenueTotal.innerHTML = `<strong>Total Revenue: </strong>R${totalRevenue.toFixed(2)}`;

        kanbanBoard.appendChild(column);
    });

    console.log('Kanban Board Structure:', kanbanBoard.innerHTML);
}

    // Helper function to generate random colors
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }


    // Initialize Dragula
// Initialize Dragula
function initializeDragula() {
    const containers = Array.from(document.querySelectorAll('.kanban-cards')); // Collect all containers

    // Initialize drag-and-drop with Dragula
    dragula(containers, {
        moves: (el, source, handle, sibling) => true, // Allow any element to be draggable
        accepts: (el, target) => {
            console.log('Accepting drop:', target); // Log target drop element
            return target.classList.contains('kanban-cards');
        }
    })
    .on('drag', (el, source) => {
        console.log('Dragging:', el); // Log the item being dragged
        el.style.opacity = '0.5';  // Lower opacity while dragging
    })
    .on('dragend', (el) => {
        console.log('Drag ended:', el); // Log when dragging ends
        el.style.opacity = '1';  // Reset opacity
        el.classList.remove('gu-mirror'); // Ensure that no mirror image remains
    })
    .on('drop', (el, target, source, sibling) => {
        console.log('Item dropped:', el);  // Log the dropped item
        console.log('Dropped in container:', target.id);  // Log the target container
        console.log('Removed from container:', source.id);  // Log the source container

        if (!target.classList.contains('kanban-cards')) {
            console.log('Invalid drop target!');
            return;
        }

        // Extract updated data from the dropped item
        const newStageId = target.id.split('-')[1];
        const updatedLeads = Array.from(target.children).map((child, index) => ({
            id: child.dataset.id,
            lead_stage_id: newStageId,
            order: index,
        }));

        console.log('Updated Leads Payload:', updatedLeads);

        // Send updated data to the server to update the lead's stage
        fetch('/api/lead/stage/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ leads: updatedLeads }),  // Send the updated order of leads
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            refreshKanbanBoard(); // Refresh the board after the update
        })
        .catch(error => console.error('Error updating order:', error));

        // Update the revenue totals for both the source and target columns
        updateRevenueTotal(source);  // Update the source container's total
        updateRevenueTotal(target);  // Update the target container's total
    });
}

// Function to update the revenue total of a stage
function updateRevenueTotal(stageElement) {
    // Find the 'kanban-cards' container within the stage
    const cardContainer = stageElement.querySelector('.kanban-cards');
    
    // If the container is not found, log an error and return early
    if (!cardContainer) {
        console.error('No .kanban-cards container found in stage:', stageElement);
        return;
    }

    let totalRevenue = 0;
    const cards = cardContainer.querySelectorAll('.kanban-card');
    cards.forEach(card => {
        const revenueText = card.querySelector('p').innerText;
        const revenue = parseFloat(revenueText.replace('R', '').trim()); // Extract revenue and convert to number
        totalRevenue += revenue;
    });

    // Find or create the revenue total element at the bottom
    let revenueTotal = cardContainer.querySelector('.revenue-total');
    if (!revenueTotal) {
        revenueTotal = document.createElement('div');
        revenueTotal.classList.add('revenue-total');  // Add the necessary class for styling
        cardContainer.appendChild(revenueTotal);  // Append the revenue total at the bottom
    }

    revenueTotal.innerHTML = `<strong>Total Revenue: </strong>R${totalRevenue.toFixed(2)}`;
}

    // Refresh the board after updates
    function refreshKanbanBoard() {
        const kanbanBoard = document.getElementById('kanban-board');
        if (!kanbanBoard) {
            console.error('Kanban board element not found.');
            return;
        }

        fetch('/api/leads')
            .then(response => response.json())
            .then(stages => {
                console.log('Refreshed Stages:', stages);
                kanbanBoard.innerHTML = '';
                renderKanbanBoard(stages, kanbanBoard);
                initializeDragula(); // Reinitialize Dragula after rendering
            })
            .catch(error => console.error('Error refreshing Kanban board:', error));
    }


    // Function to load the sticky notes from local storage when the page loads
    // Load sticky notes for a specific client
    function loadStickyNotes(clientId) {
        const stickyNotesContainer = document.getElementById('sticky-notes-container');

        // Retrieve notes for the specific client from localStorage
        const notes = JSON.parse(localStorage.getItem(`stickyNotes_${clientId}`)) || [];

        // Clear the container first
        stickyNotesContainer.innerHTML = '';

        // Add the sticky notes to the container
        notes.forEach(note => {
            const stickyNote = createStickyNoteElement(note.content, note.id);
            stickyNotesContainer.appendChild(stickyNote);
        });
    }

    // Create a sticky note element
    function createStickyNoteElement(content, id) {
        const note = document.createElement('div');
        note.className = 'sticky-note';
        note.dataset.id = id || new Date().getTime(); // Use timestamp for unique ID if none exists

        note.innerHTML = `
            <h5>Note</h5>
            <p>${content}</p>
            <span class="delete-note" onclick="removeStickyNote(this)">×</span>
        `;

        return note;
    }

    // Add a sticky note for a specific client
    function addStickyNote() {
        const noteContent = document.getElementById('one-ecom-customer-note').value;
        const clientId = {{ $client->id }};  // Assume the client ID is available in the template

        if (!noteContent) return false; // Do not add empty notes

        // Create a new sticky note element
        const stickyNotesContainer = document.getElementById('sticky-notes-container');
        const newNote = createStickyNoteElement(noteContent);

        // Add the note to the container
        stickyNotesContainer.appendChild(newNote);

        // Store the note for this specific client in localStorage
        const notes = JSON.parse(localStorage.getItem(`stickyNotes_${clientId}`)) || [];
        notes.push({ id: newNote.dataset.id, content: noteContent });
        localStorage.setItem(`stickyNotes_${clientId}`, JSON.stringify(notes));

        // Clear the input field
        document.getElementById('one-ecom-customer-note').value = '';

        return false; // Prevent form submission
    }

    // Remove a sticky note
    function removeStickyNote(element) {
        const note = element.closest('.sticky-note');
        const noteId = note.dataset.id;
        const clientId = {{ $client->id }};  // Assume the client ID is available in the template

        // Remove the note from the DOM
        note.remove();

        // Remove the note from localStorage for the specific client
        let notes = JSON.parse(localStorage.getItem(`stickyNotes_${clientId}`)) || [];
        notes = notes.filter(note => note.id !== noteId);
        localStorage.setItem(`stickyNotes_${clientId}`, JSON.stringify(notes));
    }

    // Load sticky notes when the page is ready
    document.addEventListener('DOMContentLoaded', () => {
        const clientId = {{ $client->id }};  // Get the client ID from Blade
        loadStickyNotes(clientId);  // Load the sticky notes for this specific client
    });
</script>
@endsection