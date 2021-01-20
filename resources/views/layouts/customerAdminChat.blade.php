<!-- 
    Link these css in page    
<link rel="stylesheet" href="{{ asset('css/customerAdminChat.css') }}">
<link rel="stylesheet" href="{{ asset('css/chatbox.css') }}"/>
-->
<div class="customerAdminChat">
    <div class="customerAdminChat__container mb-2 collapse" id="customer-admin-chat">
         <div class="chatbox__container">
                <div class="chatbox__header">
                    <h6 class="chatbox__title">test</h6>
                </div>
                <div class="chatbox__messages tab-content">
                    <!-- TODO: UNCOMMENT ONE OF THESE -->
                    <!-- <div class="chatbox__noMessages__wrapper px-2" id="no-chat">
                        <img src="{{ asset('img/empty-chat.svg') }}" alt="no-message"/>
                        <h5 class="chatbox__noMessages__title">Mulai transaksi untuk melihat chat.</h5>
                    </div> -->
                    
                    <div class="chatbox__messages__wrapper" id="content-user-13123213">
                        <div class="chatbox__message chatbox__message--me">
                            <p>Itu karena bapak tidak baca petunjuk</p>
                        </div>
                        <div class="chatbox__message chatbox__message--other">
                            <p>Kenapa ya saya tuh begini?</p>
                        </div>
                    </div>

                    <div class="chatbox__input">
                        <form action="/admin/12312/chat" method="POST">
                            <input name="chat" placeholder="Masukkan pesan anda di sini" type="text" class="form-control">
                            <button type="submit" class="btn btn-danger">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <button class="customerAdminChat__button btn btn-danger float-right" data-toggle="collapse" data-target="#customer-admin-chat"><i class="fas fa-headset" aria-hidden="true"></i></button>
</div>