<section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
       
        <div class="ticket" style="font-family: Arial, sans-serif; margin: 0 auto; width: 500px; padding: 20px; border: 1px solid #f37a27; background-color: #f2f2f2;">
            <h2 style="text-align: center; color: #f37a27;">Vé máy bay</h2>
            
            <p><strong style="color: #f37a27;">Hãng bay:</strong> {{ ucfirst($data->airplane_brand_name) }}</p>
            <p><strong style="color: #f37a27;">Máy bay:</strong> {{ $data->airplane_name }}</p>
            
            <hr style="border-top: 1px solid #f37a27;">
            <div class="location" style="display: flex; justify-content: space-between">
                <p><strong style="color: #f37a27;">Từ:</strong> {{ $data->location_start }}</p>
                <p><strong style="color: #f37a27;">Đến:</strong> {{ $data->location_end }}</p>

            </div>
            <p><strong style="color: #f37a27;">Thời gian có mặt tại cửa ra máy bay:</strong> {{ $data->time_start }}</p>
            <hr style="border-top: 1px solid #f37a27;">
            <h5>Thông tin cá nhân</h5>
            {{-- <p><strong style="color: #f37a27;">Số ghế:</strong> 10A</p> --}}
            {{-- <p><strong style="color: #f37a27;">Cửa ra vào:</strong> D57</p>  --}}
            <p><strong style="color: #f37a27;">Họ và tên:</strong> {{ $data->fullname }}</p> 
            <p><strong style="color: #f37a27;">Giới tính:</strong> {{ $data->gender == 0 ? 'Nam' : 'Nữ' }}</p> 

            
            <hr style="border-top: 1px solid #f37a27;">
        
            <p style="text-align: center; font-size: 0.8em; color: #555;">Cửa máy bay sẽ đóng 15 phút trước giờ khởi hành. Hành khách sẽ không
                được vận chuyển nếu đến muộn. Chúc quý khách có chuyến bay vui vẻ. Trân trọng cảm ơn</p>
        </div>
        </div>
</section>