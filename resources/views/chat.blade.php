@extends('layouts/panel')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Chat</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Skote</a></li>
                                <li class="breadcrumb-item active">Chat</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="d-lg-flex">
                <div class="chat-leftsidebar me-lg-4">
                    <!-- Your existing HTML code for the left sidebar -->
                    <div class="">
                        <div class="py-4 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0 align-self-center me-3">
                                    <img src="assets/images/users/avatar-1.jpg" class="avatar-xs rounded-circle"
                                        alt="">
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-15 mb-1">Henry Wells</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>
                                        Active</p>
                                </div>

                                <div>
                                    <div class="dropdown chat-noti-dropdown active">
                                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bx bx-bell bx-tada"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="search-box chat-search-box py-4">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search...">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>

                        <div class="chat-leftsidebar-nav">
                            <ul class="nav nav-pills nav-justified">
                                <li class="nav-item">
                                    <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                        <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Chat</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#groups" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="bx bx-group font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Groups</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#contacts" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="bx bx-book-content font-size-20 d-sm-none"></i>
                                        <span class="d-none d-sm-block">Contacts</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content py-4">
                                <div class="tab-pane show active" id="chat">
                                    <div>
                                        {{-- <h5 class="font-size-14 mb-3">Recent</h5> --}}
                                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;"
                                            id="chat-list">
                                            <!-- Chat list will be populated dynamically -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 user-chat">
                    <div class="card">
                        <div class="p-4 border-bottom ">
                            <div class="row">
                                <div class="col-md-4 col-9">
                                    <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                                    <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active now</p>
                                </div>
                                {{-- <div class="col-md-8 col-3">
                                    <ul class="list-inline user-chat-nav text-end mb-0">
                                        <li class="list-inline-item d-none d-sm-inline-block">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-search-alt-2"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                                                    <form class="p-3">
                                                        <div class="form-group m-0">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                                                
                                                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                                                
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-inline-item  d-none d-sm-inline-block">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-cog"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">View Profile</a>
                                                    <a class="dropdown-item" href="#">Clear chat</a>
                                                    <a class="dropdown-item" href="#">Muted</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-inline-item">
                                            <div class="dropdown">
                                                <button class="btn nav-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-horizontal-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else</a>
                                                </div>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Your existing HTML code for the chat window -->
                        <div class="chat-conversation p-3">
                            <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;"
                                id="chat-messages">
                                <!-- Chat messages will be populated dynamically -->
                            </ul>
                        </div>

                        <div class="p-3 chat-input-section">
                            <div class="row">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" class="form-control chat-input" placeholder="Enter Message..."
                                            id="message-input">
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button"
                                        class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"
                                        onclick="sendMessage()">
                                        <span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // Load initial chat list and messages
            loadChatList();
            // loadChatMessages(1);
            $(document).on("click", ".chatContact", function() {
                var dataId = $(this).data("id");
                // Now 'dataId' contains the value of the 'data-id' attribute for the clicked element
                loadChatMessages(dataId);

            });
        });

        function loadChatList() {
            // Use Ajax to load chat list from the server
            $.ajax({
                url: "{{ url('api/recent-message') }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate chat list dynamically
                    var chatList = $('#chat-list');
                    chatList.empty();

                    $.each(data, function(index, chat) {
                        var listItem = '<li><a  class="chatContact" data-id="' + chat.phone + '">' +
                            '<div class="d-flex">' +
                            '<div class="flex-shrink-0 align-self-center me-3">' +
                            '<i class="mdi mdi-circle font-size-10"></i>' +
                            '</div>' +
                            '<div class="flex-shrink-0 align-self-center me-3">' +
                            '<img src="' + chat.avatar + '" class="rounded-circle avatar-xs" alt="">' +
                            '</div>' +
                            '<div class="flex-grow-1 overflow-hidden">' +
                            '<h5 class="text-truncate font-size-14 mb-1">' + chat.name + '</h5>' +
                            '<p class="text-truncate mb-0">' + chat.lastMessage + '</p>' +
                            '</div>' +
                            '<div class="font-size-11">' + chat.lastMessageTime + '</div>' +
                            '</div>' +
                            '</a></li>';

                        chatList.append(listItem);
                    });
                },
                error: function(error) {
                    console.error('Error loading chat list:', error);
                }
            });
        }


        function loadChatMessages(phone) {
            console.log(phone);

            // Use Ajax to load chat messages for the specified user
            $.ajax({
                url: "{{ url('api/message-by-contact') }}/" + phone,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate chat messages dynamically
                    var chatMessages = $('#chat-messages');
                    chatMessages.empty();

                    // $.each(data, function (index, message) {
                    //     var messageItem = '<li>' +
                    //         '<div class="chat-day-title">' +
                    //         '<span class="title">' + message.date + '</span>' +
                    //         '</div>' +
                    //         '</li>' +
                    //         '<li class="' + (message.isRight ? 'right' : '') + '">' +
                    //         '<div class="conversation-list">' +
                    //         '<div class="ctext-wrap">' +
                    //         '<div class="conversation-name">' + message.sender + '</div>' +
                    //         '<p>' + message.text + '</p>' +
                    //         '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> ' + message.time + '</p>' +
                    //         '</div>' +
                    //         '</div>' +
                    //         '</li>';

                    //     chatMessages.append(messageItem);
                    // });

                    var currentDay = null; // Variable to keep track of the current day

                    $.each(data, function(index, message) {
                        var messageDate = message
                        .date; // Assuming date is a string in the format "YYYY-MM-DD"
                        var formattedDate = formatDate(messageDate); // Format the date as you prefer

                        var isToday = isCurrentDay(messageDate);

                        if (messageDate !== currentDay) {
                            // Display a new chat-day-title
                            var dayTitle = '<li>' +
                                '<div class="chat-day-title">' +
                                '<span class="title">' + (isToday ? 'Today' : formattedDate) +
                                '</span>' +
                                '</div>' +
                                '</li>';

                            chatMessages.append(dayTitle);

                            // Update the current day
                            currentDay = messageDate;
                        }

                        // Display the message
                        var messageItem = '<li class="' + (message.isRight ? 'right' : '') + '">' +
                            '<div class="conversation-list">' +
                            '<div class="ctext-wrap">' +
                            '<div class="conversation-name">' + message.sender + '</div>' +
                            '<p>' + message.text + '</p>' +
                            '<p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> ' +
                            message.time + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</li>';

                        chatMessages.append(messageItem);
                    });

                },
                error: function(error) {
                    console.error('Error loading chat messages:', error);
                }
            });
        }

        // Function to format the date (using JavaScript Date object)
        function formatDate(dateString) {
            var date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }

        // Function to check if the date is today
        function isCurrentDay(dateString) {
            var today = new Date();
            var messageDate = new Date(dateString);

            return today.toDateString() === messageDate.toDateString();
        }

        function sendMessage() {
            var messageInput = $('#message-input').val();

            // Use Ajax to send the message to the server
            $.ajax({
                url: 'your-api-endpoint-for-sending-messages',
                type: 'POST',
                dataType: 'json',
                data: {
                    message: messageInput
                },
                success: function(response) {
                    // Handle success, maybe update the UI with the sent message
                    console.log('Message sent successfully:', response);
                },
                error: function(error) {
                    console.error('Error sending message:', error);
                }
            });
        }
    </script>
@endsection
