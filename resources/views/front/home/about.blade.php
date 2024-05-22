@extends('front.layout.template')

@section('title', 'About Laravel berita') 

    @section('content')
                <!-- Page content-->
                <div class="container">
                    <div class="row">
                        <!-- Blog entries-->
                        <div class="col-lg-8">
                            <!-- Featured blog post-->
                            <div class="card mb-4 shadow" data-aos="zoom-out" data-aos-duration="2000" >
                                
                                <div class="card-body">
                                    <div class="small text-muted">{{ date('d/m/y') }}</div>
                                    <h2 class="card-title">About</h2>
                                    <p class="card-text">
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla, blanditiis. Aliquam facilis laudantium a, consequuntur culpa consequatur, corrupti similique velit totam, dolore amet adipisci maxime vitae accusantium cumque. Provident, ducimus?
                                        </p>
                                        <p>
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem, veritatis illo sequi impedit perferendis nobis unde nesciunt asperiores iste quod quaerat vel sunt, et dolor ullam laudantium odio repudiandae enim.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis beatae, maxime facere rerum nulla reprehenderit praesentium aliquid dolores velit, eius porro nemo ab, quo dolorem. Explicabo illo veniam quibusdam pariatur.
                                        </p>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde vel rem asperiores cumque. Nemo reprehenderit sint ab, unde iusto incidunt. Voluptates saepe quae consequuntur eos libero velit alias deserunt odit.
                                        </p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Side widgets-->
                        @include('front.layout.side-widget')
                    </div>
                </div>
    @endsection
        <!-- Footer-->
  