<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>To-Do List</title>
    <style>
        .task-list {
            max-width: 400px;
            margin: 0 auto;
        }

        .task-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .task-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .task-item .task-text {
            flex-grow: 1;
        }

        .fa-comment-dots:hover {
            color: green;
        }

        .fa-pencil:hover {
            color: blue;
        }

        .fa-trash-can:hover {
            color: red;
        }
    </style>
</head>

<body>
<div class="container">

    <div class="task-list">
        <header class="d-flex">
            <h1 class="my-5">Todo Task</h1>
            <button data-bs-toggle="modal" data-bs-target="#addTask" class="btn btn-primary btn-sm my-5 ms-5"
                    style="height: fit-content">
                <i class="fa-solid fa-plus"></i>
                Add New
            </button>
        </header>

        @foreach($tasks as $task)
            <div class="task-item">
                <i class="fa-solid fa-circle me-3 {{ $task->status == 0 ? 'text-danger' : 'text-success'  }}"
                   onClick="markAsDone({{ $task->id }}, {{ $task->status }})"></i>
                <label for="task1" class="task-text">{{ $task->title }} </label>
                <i class="fa-solid fa-comment-dots me-3" data-bs-toggle="modal" data-bs-target="#addComment"></i>
                <i class="fa-solid fa-pencil me-3" data-bs-toggle="modal" data-bs-target="#editTask"></i>
                <i class="fa-solid fa-trash-can" data-bs-toggle="modal" data-bs-target="#deleteTask"
                   onClick="deleteTask({{ $task->id }})"></i>
            </div>
        @endforeach

    </div>
</div>

@include("components/add-task");
@include("components/edit-task")
@include("components/add-comment")
@include("components/delete-task")

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script>
    const requestOptions = {
        method: "PATCH",
        headers: {
            'Content-Type': "Application/Json",
            'X-CSRF-TOKEN': csrfToken,
        },

    }

    function deleteTask(id) {
        document.querySelector("#taskId").value = id;
    }


    function markAsDone(id, status) {
        if (Number(status) === 1) return;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = fetch(`task/${id}/updateStatus`, {
            requestOptions,
            body: JSON.stringify({
                id: id
            })
        }).then(response => response.json)
            .then(data => {
                alert("Task Completed!");
                location.reload();
            }).catch(error => console.log(error))
    }


</script>
</body>

</html>
