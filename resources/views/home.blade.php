
<x-layout>

    <x-header/>

    <div class="ciri">

        <div class="ciri-main">

            {{-- TASK LIST --}}
            <div id="tasks-panel" class="panel active task-list">
                
                <div class="panel-top">
                    <h2>My Tasks {{ $tasks->where('completed', false)->count() }}</h2>
                    {{-- <p>{{ $tasks->where('completed', false)->count() }}</p> --}}
                    <form id="clearForm" action="{{ route('tasks.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmClear()" id="clear-tasks-btn" class="clear-btn">Clear Tasks</button>
                    </form>
                </div>
                
                <div class="task-container">
                    @if($tasks->where('completed', false)->isEmpty())
                        <p>Let's get to it!</p>
                    @else
                        @foreach($tasks->where('completed', false) as $task)
                            <article class="task">
                                <h4>{{ $task->name }}</h4>
                                <p class="task-description">{{ $task->description }}</p>
                                <div class="task-bottom">
                                    <form action="{{ url('/tasks/'.$task->id.'/complete') }}" method="POST" class="mark-complete-form">
                                        @csrf
                                        <button class="mark-complete-btn" type="submit"><i class="fa-solid fa-check"></i>Mark Complete</button>
                                    </form>    
                
                                    <form action="{{ url('/tasks/'.$task->id.'/delete') }}" method="POST" class="delete-form">
                                        @csrf
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <i class="fas fa-trash-alt task-delete-icon"></i>
                                        </button>
                                    </form>            
                                </div>
                            </article>
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- Completed Task List --}}
            <div id="completed-panel" class="panel completed-list">
                
                <div class="panel-top">
                    <h2>Completed Tasks {{ $tasks->where('completed', true)->count() }}</h2>
                    {{-- CLEAR COMPLETED TASKS --}}
                    <form id="clearCompletedForm" action="{{ route('tasks.clearcompleted') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmCompletedClear()" id="clear-completed-tasks-btn" class="clear-btn">Clear Completed Tasks</button>
                    </form>
                </div>
                
                <div class="task-container">
                    @if($tasks->where('completed', true)->isEmpty())
                        <p>Let's get to it!</p>
                    @else
                    @foreach($tasks->where('completed', true) as $task)
                        <article class="task">
                            <h4>{{ $task->name }}</h4>
                            <p class="task-description">{{ $task->description }}</p>
                            <div class="task-bottom">
                                <form action="{{ url('/tasks/'.$task->id.'/incomplete') }}" method="POST" class="mark-complete-form">
                                    @csrf
                                    <button class="mark-complete-btn" type="submit"><i class="fa-solid fa-check"></i>Mark incomplete</button>
                                </form>    
            
                                <form action="{{ url('/tasks/'.$task->id.'/delete') }}" method="POST" class="delete-form">
                                    @csrf
                                    <button type="submit" style="border: none; background: none; cursor: pointer;">
                                        <i class="fas fa-trash-alt task-delete-icon"></i>
                                    </button>
                                </form>            
                            </div>
                        </article>
                    @endforeach
                    @endif
            </div>
            </div>


            <div class="task-form-container">
                {{-- ADD TASK FORM --}}
                <h2>Add Task</h2>
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
    
                <form class="create-task-form" action="{{ url('/tasks') }}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <textarea name="description" id="description" placeholder="Description"></textarea>
                    <button class="add-task-btn" type="submit">Add Task</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>

