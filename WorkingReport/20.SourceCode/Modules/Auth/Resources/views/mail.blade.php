<div>

    <strong>Chào {{$user['name']}} !</strong>,
    <p>Một yêu cầu thiết lập lại mật khẩu đã được kích hoạt.</p>

    <div>
        <p>
            Để hoàn tất quy trình vui lòng click vào liên kết dưới đây để đặt lại mật khẩu trong vòng 1h.Bỏ qua email này nếu bạn không phải là người yêu cầu.
        </p>
        <div style="text-align: center">
            <a href="{{$user['url']}}"
                style="font-family: Avenir, Helvetica, sans-serif;
                box-sizing: border-box;
                border-radius: 3px;
                box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
                color: #FFF;
                display: inline-block;
                text-decoration: none;
                -webkit-text-size-adjust: none;
                background-color: #3097D1;
                border-top: 10px solid #3097D1;
                border-right: 18px solid #3097D1;
                border-bottom: 10px solid #3097D1;
                border-left: 18px solid #3097D1;">
                Đặt lại mật khẩu
            </a>
        </div>


    </div>

    Trân trọng !,
    <br/>
    <p>{{$user['sender']}} </p>

    <div>
        <p>Nếu bạn gặp sự cố khi nhấp vào nút "Đặt lại mật khẩu", sao chép và dán URL bên dưới đây vào trình duyệt web của bạn: </p>
        <br>
        <a href="{{$user['url']}}">{{$user['url']}}</a>
    </div>
</div>

