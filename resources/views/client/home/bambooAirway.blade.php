<section class="page-section" id="bambooairway">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">Hành trình bay Bamboo Airwway</h2>
        <hr class="divider" />
    </div>
</section>
<!-- Portfolio-->
<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">
            @foreach ($flightBamboo as $flight)
                <div class="col-lg-4 col-sm-6">
                    <a data-id="{{ $flight->id }}" data-brand="{{ $flight->brand }}" style="cursor: pointer"
                        class="portfolio-box" data-toggle="modal" data-target="#exampleModal">
                        <img width="100%" height="100%" class="img-fluid" src="{{ Storage::url($flight->image) }}"
                            alt="{{ $flight->name }}" />
                        <div class="portfolio-box-caption">
                            <div class="project-name">{{ $flight->name }}</div>
                        </div>
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết hành trình bay</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
