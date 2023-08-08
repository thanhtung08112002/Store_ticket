<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">Hãng máy bay</h2>
        <hr class="divider" />
        <div class="row gx-4 gx-lg-5">
            @foreach ($airplanebrands as  $brand)
                
            <a href="#{{ $brand->name }}" style="text-decoration: none" class="col-lg-6 col-md-6 text-center">
                <div class="mt-5">
                    <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                    <h3 class="h4 mb-2">{{ ucfirst($brand->name) }}</h3>
                </div>
                <div class="mt-5">
                    <table class="table">
                    <tbody>
                        <tr>
                            <td >Thông tin</td>
                            <td>{{ $brand->information }}</td>
                        </tr>
                            {{-- <tr>
                                <td >Khuyễn mãi</td>
                                <td>Giảm 20% cho toàn bộ chuyến bay</td>
                            </tr> --}}
                    </tbody>
                    </table>
                </div>
            </a>
            @endforeach
         
        </div>
    </div>
</section>