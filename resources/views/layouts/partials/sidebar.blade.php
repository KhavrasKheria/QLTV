<div class="sidebar d-flex flex-column">

    {{-- USER SECTION --}}
    <div class="user-section text-center py-3">
        <div class="user-icon mb-2">
            <i class="bi bi-person-circle fs-1"></i>
        </div>
        <span class="user-name fw-semibold">{{ Auth::user()->name }}</span>
    </div>

    <hr>

    {{-- MENU --}}
    <ul class="nav flex-column w-100 px-2 flex-grow-1">

        {{-- QUẢN LÝ SÁCH --}}
        <li class="nav-item">
            <a class="nav-link d-flex justify-content-between align-items-center"
                data-bs-toggle="collapse"
                href="#quanLySachMenu"
                role="button"
                aria-expanded="true"
                aria-controls="quanLySachMenu">
                <span>
                    <i class="bi bi-journal-bookmark"></i> Quản lý sách
                </span>
                <i class="bi bi-chevron-down"></i>
            </a>

            <div class="collapse show ps-3" id="quanLySachMenu">
                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a href="{{ route('sach.index') }}" class="nav-link">
                            <i class="bi bi-book"></i> Danh mục sách
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('vitri.index') }}" class="nav-link">
                            <i class="bi bi-geo-alt"></i> Vị trí sách
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('tacgia.index') }}" class="nav-link">
                            <i class="bi bi-person-lines-fill"></i> Tác giả
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('nhaxuatban.index') }}" class="nav-link">
                            <i class="bi bi-building"></i> Nhà xuất bản
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('theloai.index') }}" class="nav-link">
                            <i class="bi bi-tags"></i> Thể loại
                        </a>
                    </li>

                </ul>
            </div>
        </li>

    </ul>


    {{-- LOGOUT --}}
    <div class="mt-auto w-100 mb-3">
        <a href="{{ route('logout') }}"
            class="nav-link d-flex justify-content-center align-items-center gap-2"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right fs-4"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </div>

</div>