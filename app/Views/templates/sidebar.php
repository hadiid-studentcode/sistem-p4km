<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="<?= base_url('dashboard') ?>" class="app-brand-link">
            <img src="<?= base_url('assets/img/logo/logo.png') ?>" alt="" class="app-brand-logo demo" width="50" height="50">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SIP4KM</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item <?= (current_url() == base_url('dashboard')) ? 'active' : '' ?>">
            <a href="<?= base_url('dashboard') ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        <?php if (session()->get('role') == 'kepala dinas') : ?>
            <li class="menu-item <?= (current_url() == base_url('cetaklaporan')) ? 'active' : '' ?>">
                <a href="<?= base_url('cetaklaporan') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-printer"></i>
                    <div data-i18n="Analytics">Cetak Laporan</div>
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'kabid') : ?>
            <li class="menu-item <?= (current_url() == base_url('jadwalkunjungan')) ? 'active' : '' ?>">
                <a href="<?= base_url('jadwalkunjungan') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div data-i18n="Analytics">Jadwal Kunjungan</div>
                </a>
            </li>
            <li class="menu-item <?= (current_url() == base_url('laporanpembinaan')) ? 'active' : '' ?>">
                <a href="<?= base_url('laporanpembinaan') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Laporan Pembinaan</div>
                </a>
            </li>
        <?php endif; ?>

        <?php if (session()->get('role') == 'p4km') : ?>
            <li class="menu-item <?= (current_url() == base_url('laporanpembinaan')) ? 'active' : '' ?>">
                <a href="<?= base_url('laporanpembinaan') ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Laporan Pembinaan</div>
                </a>
            </li>
        <?php endif; ?>





    </ul>
</aside>