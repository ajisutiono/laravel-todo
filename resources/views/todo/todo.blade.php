@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <form action="#" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-3">
                            {{-- <label for="name" class="col-md-4 col-form-label">Add Todo</label> --}}

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="Name">
                                
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
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

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
                                        <td>{{ $todo['name'] }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">Remove</button>

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
