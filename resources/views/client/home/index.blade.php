@extends('client.layouts.master')

@section('main')
    <section class="page-section bg-primary" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="text-white mt-0">Dưới đây là hãng máy bay tốt nhất dành cho quý khách</h2>
                    <hr class="divider divider-light" />
                    <p class="text-white-75 mb-4">Chúng tôi luôn đem đến sự tiện nghỉ cho quý khách</p>
                    <a class="btn btn-light btn-xl" href="#services">Tiếp tục</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Services-->
    @include('client.home.service')
    {{-- code sale --}}
    @include('client.home.codeSale')
    {{-- Bamboo fight --}}
    @include('client.home.bambooAirway')
    {{-- vietnamairline fight --}}
    @include('client.home.vietnamAirline')

    <!-- Call to action-->
   
    <!-- Contact-->
    {{-- <section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Let's Get In Touch!</h2>
                <hr class="divider" />
                <p class="text-muted mb-5">Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!</p>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
            
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <!-- Name input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                        <label for="name">Full name</label>
                        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                    </div>
                    <!-- Email address input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                    </div>
                    <!-- Phone number input-->
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                        <label for="phone">Phone number</label>
                        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                    </div>
                    <!-- Message input-->
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                        <label for="message">Message</label>
                        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center mb-3">
                            <div class="fw-bolder">Form submission successful!</div>
                            To activate this form, sign up at
                            <br />
                            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton" type="submit">Submit</button></div>
                </form>
            </div>
        </div>
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-4 text-center mb-5 mb-lg-0">
                <i class="bi-phone fs-2 mb-3 text-muted"></i>
                <div>+1 (555) 123-4567</div>
            </div>
        </div>
    </div>
</section> --}}
@endsection

@section('scripts')
    <script>
        $("a.portfolio-box").click((e) => {
            let id = $(e.currentTarget).data('id');
            let airBrand = $(e.currentTarget).data('brand');
            $.ajax({
                type: "post",
                url: `ajax/details/`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    airBrand: airBrand
                },
                dataType: "json",
                success: function(response) {
                    let res = `    <div class="row">
                                        <div class="col-7">
                                            <img src="/storage/${response.image}" alt="" height="500px" width="100%">
                                        </div>
                                        <div class="col-5">
                                            <div class="modal-body-information">
                                                <h5>Tên chuyến bay: ${response.name} </h5>
                                                <h5>Điểm bắt đầu: ${response.location_start} </h5>
                                                <h5>Điểm đến: ${response.location_end} </h5>
                                                <h5>Thời gian bắt đầu: ${response.time_start} </h5>
                                                <h5>Loại vé: ${response.type_way} </h5>
                                                <h5>Giá: ${response.price}VNĐ/Vé</h5>
                                                <h5>Thông tin: </h5>
                                                <textarea disabled class="form-control">${response.information} </textarea>
                                                <a href="cart/checkout/${response.id}" class="btn btn-primary">Đặt vé</a>
                                            </div>
                                        </div>
                                    </div>`
                    $(".modal-body")
                        .html(res);
                }
            });

        });
    </script>
@endsection
