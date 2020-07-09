@extends('layouts.blog')

@section('content')

<!--Adventures Grid Start-->
<div id="lista" class="adventures-grid section-padding list">
    <div class="container">
        <div class="shop-item-filter">
            <form action="#" id="banner-searchbox">
                <div class="row">
                    <div class="col-lg-4 hidden-md col-sm-12">
                        <p>Showing Trips 1 to 12 of 19 total</p>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-4">
                        <div class="adventure-cat box-small">
                            <select name="type" class="search-adventure">
                                <option>Adventure Type</option>
                                <option>Bungee jumping</option>
                                <option>Bicycle touring</option>
                                <option>Jungle tourism</option>
                                <option>Shark tourism</option>
                                <option>Mountain biking</option>
                                <option>Mountaineering</option>
                                <option>Rock Adventure</option>
                            </select>
                        </div>
                    </div>    
                    <div class="col-lg-2 col-md-4 col-sm-5">
                        <div class="adventure-cat box-small">
                            <select name="level" class="search-adventure">
                                <option>Easy Level</option>
                                <option>Advance Level</option>
                                <option>Moderate Level</option>
                                <option>Basic Level</option>
                            </select>
                        </div>
                    </div>    
                    <div class="col-md-2 hidden-sm">    
                        <div class="adventure-cat box-small">
                            <select name="price" class="search-adventure">
                                <option>Price</option>
                                <option>$100-$300</option>
                                <option>$400-$600</option>
                                <option>$700-$800</option>
                                <option>$900-$1000</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-2 col-sm-3">
                        <div class="adventure-tab clearfix">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs navbar-left">
                                <li><a href="shop-grid-no-sidebar.html" class="grid-view">Shop Grid No Sidebar</a></li>
                                <li><a href="shop-grid-with-sidebar.html" class="list-view">Shop Grid With Sidebar</a></li>
                            </ul>
                        </div>
                    </div>
                </div>        
            </form>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            @foreach($trilhas as $trilha)

                @php 

                    $foto = $trilha->foto->where('id_tipo_foto_tfo',7)->first();
                    $img = !empty($foto->nm_path_fot) ? $foto->nm_path_fot : 'padrao.jpg';
                    $alt = !empty($foto->dc_alt_fot) ? $foto->dc_alt_fot : 'Foto';
                    
                @endphp

                <div class="col-md-12">
                <div class="single-list-item">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="adventure-img">
                                <a href="{{ url($trilha->ds_url_tri) }}"><img src="{{ asset('img/trilhas/busca/'.$img) }} " alt="{{$alt}}"></a>
                                
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-7 margin-left-list">
                            <div class="adventure-list-container">
                                <div class="adventure-list-text">
                                    <h1><a href="#">{{$trilha->nm_trilha_tri}}</a></h1>
                                    <p>
                                        {{ \Illuminate\Support\Str::limit(utf8_encode($trilha->ds_trilha_tri), 200, $end='...') }}
                                    </p>
                                    <div class="list-buttons">
                                        <a href="{{ url($trilha->ds_url_tri) }}" class="button-one button-blue">LER MAIS</a>
                                        <div class="list-rating">
                                            <i class="fa fa-star color"></i>
                                            <i class="fa fa-star color"></i>
                                            <i class="fa fa-star color"></i>
                                            <i class="fa fa-star color"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <div class="adventure-list-link">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                            <a href="#"><i class="fa fa-linkedin"></i></a>
                                            <a href="#"><i class="fa fa-rss"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="adventure-list-image">
                                    <div class="image-top">
                                        <img src="img/icon/level.png" alt="">
                                    </div>
                                    <h2>Easy level</h2>
                                    <ul class="image-bottom">
                                        <li><img src="img/icon/35.png" alt=""></li>
                                        <li><img src="img/icon/36.png" alt=""></li>
                                        <li><img src="img/icon/37.png" alt=""></li>
                                        <li><img src="img/icon/38.png" alt=""></li>
                                        <li><img src="img/icon/39.png" alt=""></li>
                                        <li><img src="img/icon/40.png" alt=""></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-content">
            <div class="pagination-button">
                <ul class="pagination">
                    <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                    <li class="current"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                </ul>
            </div>
        </div>    
    </div>
</div>
<!--End of Adventures Grid-->
<!--Blog Area Start-->
<div class="blog-area section-padding blog-three-area">
    <div class="container">              
        <div class="row">
            <div class="col-md-12">
                <div class="section-title title-three text-center">
                    <div class="title-border">
                        <h1>Latest <span>Blog Posts</span></h1>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dolor turpis, pulvinar varius dui<br> id, convallis iaculis eros. Praesent porta lacinia elementum.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="blog-carousel">
                <div class="col-md-6">
                    <div class="single-blog hover-effect">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="blog-image box-hover">
                                    <a href="blog-details.html"><img src="img/blog/1.jpg" alt=""></a>
                                    <div class="date-time">
                                        <span class="date">10</span>
                                        <span class="month">AUG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 margin-left">
                                <div class="blog-text">
                                    <h4><a href="blog-details.html">What is travel? We answer the big, burning question.....</a></h4>
                                    <p>The question of What Travel Is is interesting, but more for what it tells you about the people doing the asking. The question of What Travel Is is interesting, but more for what it tells you about the people doing the asking.</p>
                                    <a href="blog-details.html" class="button-one">Learn More</a>
                                    <div class="blog-link">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-rss"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-6">
                    <div class="single-blog hover-effect">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="blog-image box-hover">
                                    <a href="blog-details.html"><img src="img/blog/2.jpg" alt=""></a>
                                    <div class="date-time">
                                        <span class="date">10</span>
                                        <span class="month">AUG</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 margin-left">
                                <div class="blog-text">
                                    <h4><a href="blog-details.html">What is travel? We answer the big, burning question.....</a></h4>
                                    <p>The question of What Travel Is is interesting, but more for what it tells you about the people doing the asking. The question of What Travel Is is interesting, but more for what it tells you about the people doing the asking.</p>
                                    <a href="blog-details.html" class="button-one">Learn More</a>
                                    <div class="blog-link">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                        <a href="#"><i class="fa fa-rss"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Blog Area-->
@endsection

