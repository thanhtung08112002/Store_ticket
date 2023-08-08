 <section class="page-section bg-dark text-white" id="code_sale">
     <div class="container px-4 px-lg-5 text-center">
         <h2 class="mb-4">Danh sách mã ưu đãi</h2>
         <table class="table text-white">
             <thead>
                 <th>Mã code</th>
                 <th>Thông tin</th>
             </thead>
             <tbody>
                 @foreach ($coupons as $coupon)
                     <tr>
                         <td>{{ $coupon->code_sale }}</td>
                         <td>Giảm {{ $coupon->discount }} %</td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </section>
