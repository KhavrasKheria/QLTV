<header id="tg-header" class="tg-header tg-haslayout">

    <div class="tg-middlecontainer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong class="tg-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('book_library/images/logo.png') }}" alt="Book Library">
                        </a>
                    </strong>

                    <div class="tg-userlogin">
                        <figure>
                            <a href="{{ asset('javascript:void(0);') }}">
                                <img src="{{ asset('book_library/images/users/kiet1.jpg') }}" alt="image description">
                            </a>
                        </figure>
                        <span>Alexander Isac</span>
                    </div>

                    <div class="tg-searchbox">
                        <form method="GET"
                            action="{{ route('search') }}"
                            class="tg-formtheme tg-formsearch"
                            id="searchForm">

                            <fieldset style="position: relative;">
                                <input type="text"
                                    name="q"
                                    id="searchInput"
                                    value="{{ request('q') }}"
                                    class="form-control"
                                    placeholder="Tìm theo tên sách, tác giả, NXB...">

                                {{-- 🎤 Micro --}}
                                <button type="button"
                                    id="micBtn"
                                    title="Tìm bằng giọng nói"
                                    style="
                        position:absolute;
                        right:45px;
                        top:50%;
                        transform:translateY(-50%);
                        background:none;
                        border:none;
                        cursor:pointer;
                    ">
                                    🎤
                                </button>

                                {{-- 🔍 Submit --}}
                                <button type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                            </fieldset>

                            <a href="javascript:void(0)">+ Advanced Search</a>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="tg-navigationarea">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <nav id="tg-nav" class="tg-nav">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                            <ul>
                                <li class="menu-item-has-children menu-item-has-mega-menu">
                                    <a href="{{ asset('javascript:void(0);') }}">All Categories</a>
                                    <div class="mega-menu">
                                        <ul class="tg-themetabnav" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="{{ asset('#artandphotography') }}" aria-controls="artandphotography" role="tab" data-toggle="tab">Art &amp; Photography</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#biography') }}" aria-controls="biography" role="tab" data-toggle="tab">Biography</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#childrensbook') }}" aria-controls="childrensbook" role="tab" data-toggle="tab">Children’s Book</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#craftandhobbies') }}" aria-controls="craftandhobbies" role="tab" data-toggle="tab">Craft &amp; Hobbies</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#crimethriller') }}" aria-controls="crimethriller" role="tab" data-toggle="tab">Crime &amp; Thriller</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#fantasyhorror') }}" aria-controls="fantasyhorror" role="tab" data-toggle="tab">Fantasy &amp; Horror</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#fiction') }}" aria-controls="fiction" role="tab" data-toggle="tab">Fiction</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#fooddrink') }}" aria-controls="fooddrink" role="tab" data-toggle="tab">Food &amp; Drink</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#graphicanimemanga') }}" aria-controls="graphicanimemanga" role="tab" data-toggle="tab">Graphic, Anime &amp; Manga</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="{{ asset('#sciencefiction') }}" aria-controls="sciencefiction" role="tab" data-toggle="tab">Science Fiction</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content tg-themetabcontent">
                                            <div role="tabpanel" class="tab-pane active" id="artandphotography">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="biography">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="childrensbook">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="craftandhobbies">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="crimethriller">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="fantasyhorror">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="fiction">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="fooddrink">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="graphicanimemanga">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="sciencefiction">
                                                <ul>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>History</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Veniam quis nostrud</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Exercitation</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Laboris nisi ut aliuip</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Commodo conseat</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Duis aute irure</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Architecture</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Tough As Nails</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Pro Grease Monkey</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Building Memories</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Bulldozer Boyz</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Build Or Leave On Us</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                    <li>
                                                        <div class="tg-linkstitle">
                                                            <h2>Art Forms</h2>
                                                        </div>
                                                        <ul>
                                                            <li><a href="{{ asset('products.html') }}">Consectetur adipisicing</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Aelit sed do eiusmod</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Tempor incididunt labore</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Dolore magna aliqua</a></li>
                                                            <li><a href="{{ asset('products.html') }}">Ut enim ad minim</a></li>
                                                        </ul>
                                                        <a class="tg-btnviewall" href="{{ asset('products.html') }}">View All</a>
                                                    </li>
                                                </ul>
                                                <ul>
                                                    <li>
                                                        <figure><img src="{{ asset('book_library/images/img-01.png') }}" alt="image description"></figure>
                                                        <div class="tg-textbox">
                                                            <h3>More Than<span>12,0657,53</span>Books Collection</h3>
                                                            <div class="tg-description">
                                                                <p>Consectetur adipisicing elit sed doe eiusmod tempor incididunt laebore toloregna aliqua enim.</p>
                                                            </div>
                                                            <a class="tg-btn" href="{{ asset('products.html') }}">view all</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item-has-children current-menu-item">
                                    <a href="{{ asset('javascript:void(0);') }}">Home</a>
                                    <ul class="sub-menu">
                                        <li class="current-menu-item"><a href="{{ asset('index-2.html') }}">Home V one</a></li>
                                        <li><a href="{{ asset('indexv2.html') }}">Home V two</a></li>
                                        <li><a href="{{ asset('indexv3.html') }}">Home V three</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="{{ asset('javascript:void(0);') }}">Authors</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ asset('authors.html') }}">Authors</a></li>
                                        <li><a href="{{ asset('authordetail.html') }}">Author Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ asset('products.html') }}">Best Selling</a></li>
                                <li><a href="{{ asset('products.html') }}">Weekly Sale</a></li>
                                <li class="menu-item-has-children">
                                    <a href="{{ asset('javascript:void(0);') }}">Latest News</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ asset('newslist.html') }}">News List</a></li>
                                        <li><a href="{{ asset('newsgrid.html') }}">News Grid</a></li>
                                        <li><a href="{{ asset('newsdetail.html') }}">News Detail</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ asset('contactus.html') }}">Contact</a></li>
                                <li class="menu-item-has-children current-menu-item">
                                    <a href="{{ asset('javascript:void(0);') }}"><i class="icon-menu"></i></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="{{ asset('aboutus.html') }}">Products</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ asset('products.html') }}">Products</a></li>
                                                <li><a href="{{ asset('productdetail.html') }}">Product Detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ asset('aboutus.html') }}">About Us</a></li>
                                        <li><a href="{{ asset('404error.html') }}">404 Error</a></li>
                                        <li><a href="{{ asset('comingsoon.html') }}">Coming Soon</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <script>
let recognition;
let isListening = false;

document.getElementById('micBtn').addEventListener('click', () => {

    if (!('webkitSpeechRecognition' in window)) {
        alert('Trình duyệt không hỗ trợ nhận diện giọng nói. Vui lòng dùng Chrome.');
        return;
    }

    if (!recognition) {
        recognition = new webkitSpeechRecognition();
        recognition.lang = 'vi-VN';
        recognition.continuous = false;
        recognition.interimResults = false;

        recognition.onresult = function (event) {
            const text = event.results[0][0].transcript;
            document.getElementById('searchInput').value = text;

            // 🔥 Tự submit (có thể bỏ nếu không thích)
            document.getElementById('searchForm').submit();
        };

        recognition.onerror = function () {
            stopListening();
        };

        recognition.onend = function () {
            stopListening();
        };
    }

    if (!isListening) {
        recognition.start();
        isListening = true;
        document.getElementById('micBtn').style.color = 'red';
    } else {
        stopListening();
    }
});

function stopListening() {
    if (recognition) recognition.stop();
    isListening = false;
    document.getElementById('micBtn').style.color = '';
}
</script>

</header>