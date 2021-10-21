<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>
        @if(session()->get('language') == 'vietnamese')
            Phân loại
        @else
            Categories
        @endif
    </div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach($categories as $category)
                <li class="dropdown menu-item">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon {{ $category->category_icon }}" aria-hidden="true"></i>
                        @if(session()->get('language') == 'vietnamese')
                            {{ $category->category_name_vn }}
                        @else
                            {{ $category->category_name_en }}
                        @endif
                    </a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                @php
                                    $subCategories = $category->subCategory;
                                @endphp
                                @foreach($subCategories as $subCategory)
                                    <div class="col-sm-12 col-md-3">
                                        <a href="{{ url('subcategory/product/'.$subCategory->id.'/'.$subCategory->subcategory_slug_en) }}">
                                            <h2 class="title">
                                                @if(session()->get('language') == 'vietnamese')
                                                    {{ $subCategory->subcategory_name_vn }}
                                                @else
                                                    {{ $subCategory->subcategory_name_en }}
                                                @endif
                                            </h2>
                                        </a>
                                        @php
                                            $subSubCategories = $subCategory->subSubCategory;
                                        @endphp
                                        @foreach($subSubCategories as $subSubCategory)
                                            <ul class="links list-unstyled">
                                                <li>
                                                    <a href="{{ url('subsubcategory/product/'.$subSubCategory->id.'/'.$subSubCategory->subsubcategory_slug_en) }}">
                                                        @if(session()->get('language') == 'vietnamese')
                                                            {{ $subSubCategory->subsubcategory_name_vn }}
                                                        @else
                                                            {{ $subSubCategory->subsubcategory_name_en }}
                                                        @endif
                                                    </a>
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>
                            @endforeach
                            <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- /.yamm-content -->
                    </ul>
                    <!-- /.dropdown-menu -->
                </li>
                <!-- /.menu-item -->
            @endforeach

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
