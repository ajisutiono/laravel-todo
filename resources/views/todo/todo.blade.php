@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <form action="/todo" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- <label for="name" class="col-md-4 col-form-label">Add Todo</label> --}}

                            <div class="col-md-6">
                                <input id="todo" type="text" class="form-control" name="todo"
                                    placeholder="Add Todo in here">

                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary">Add Todo</button>
                            </div>



                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-header">
                        Todo List
                    </div>

                    <div class="card-body">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                    <tr>
                                        <th scope="row">{{ $todo['id'] }}</th>
                                        <td>{{ $todo['todo'] }}</td>
                                        <td>
                                            <form action="/todo/{{ $todo['id'] }}/delete" method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-danger" type="submit">Remove</button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    @endsection
