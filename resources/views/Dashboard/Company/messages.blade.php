@extends('Dashboard.Company.Layouts.app')

@section('content')
    <span class="d-none">
        @csrf
    </span>
    <div class="container" dir="ltr">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0" id="userList">

                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="#" alt="avatar" id="userSelectedLogo">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0" id="userSelectedName"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="chat-history" style="height: 65vh; overflow-x: auto;" >
                            <ul class="m-b-0" id="chatBox" dir="rtl">

                            </ul>
                        </div>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">
                                <div class="input-group-prepend">
                                    <button disabled class="btn btn-secondary disabled" id="sendButton">send</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Enter text here..." id="inputMessage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script src="{{asset('js/appChatCompany.js')}}"></script>
@endsection

@section("css")
    <link rel="stylesheet" href="{{asset('css/appChat.css')}}">

@endsection
