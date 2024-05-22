@extends('front.layout.template')

@section('title', 'Contact Laravel berita') 

    @section('content')
                <!-- Page content-->
                <div class="container">
                    <div class="row">
                        <!-- Blog entries-->
                        <div class="col-lg-8">
                            <!-- Featured blog post-->
                            <div class="card mb-4 shadow" data-aos="fade-up" data-aos-duration="2000" >
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1979.6661644748071!2d110.31015329618683!3d-7.087419755430173!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706269ffea470f%3A0xc4b8accc56ee5d8a!2sJl.%20Amarta%20II%2C%20Cangkiran%2C%20Kec.%20Mijen%2C%20Kota%20Semarang%2C%20Jawa%20Tengah%2050216!5e0!3m2!1sid!2sid!4v1716274228311!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <div class="card-body">
                                    <div class="small text-muted">{{ date('d/m/y') }}</div>
                                    <h2 class="card-title">Contact</h2>
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
  