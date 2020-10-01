const pathFooterAllowed = ["/", "/about"];
const footer = `
    <div class="footer">
        <div class="footer__section">
            <div class="footer__address">
                <p class="footer__section__title">Alamat</p>
                <div class="footer__section__content">
                    <p>Infiniti Office, Belleza BSA, Jl. Permata Hijau No. 106, Kec. Kby. Lama, Jakarta, Daerah Khusus Ibukota Jakarta 12210</p>
                </div>
            </div>
            <div class="footer__navigation">
                <p class="footer__section__title">Navigasi</p>
                <div class="footer__section__content">
                    <a href="">Beranda</a>
                    <a href="">Tentang Kami</a>
                </div>
            </div>
            <div class="footer__contact">
                <p class="footer__section__title">Kontak Kami</p>
                <div class="footer__section__content">
                    <span class="footer__contact--phone">
                        <p>(+62) 85695645050</p>
                        <strong>Alberto Dhammavirya</strong>
                    </span>
                    <div class="footer__contact--socmed">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5 1.16669H8.74998C7.97643 1.16669 7.23457 1.47398 6.68759 2.02096C6.1406 2.56794 5.83331 3.30981 5.83331 4.08335V5.83335H4.08331V8.16669H5.83331V12.8334H8.16665V8.16669H9.91665L10.5 5.83335H8.16665V4.08335C8.16665 3.92864 8.22811 3.78027 8.3375 3.67088C8.4469 3.56148 8.59527 3.50002 8.74998 3.50002H10.5V1.16669Z"/>
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.33337 4.66669C10.2616 4.66669 11.1519 5.03544 11.8082 5.69181C12.4646 6.34819 12.8334 7.23843 12.8334 8.16669V12.25H10.5V8.16669C10.5 7.85727 10.3771 7.56052 10.1583 7.34173C9.93954 7.12294 9.64279 7.00002 9.33337 7.00002C9.02396 7.00002 8.72721 7.12294 8.50842 7.34173C8.28962 7.56052 8.16671 7.85727 8.16671 8.16669V12.25H5.83337V8.16669C5.83337 7.23843 6.20212 6.34819 6.8585 5.69181C7.51488 5.03544 8.40512 4.66669 9.33337 4.66669Z" />
                                <path d="M1.16669 5.25H3.50002V12.25H1.16669V5.25Z" />
                                <path d="M2.33335 3.50002C2.97769 3.50002 3.50002 2.97769 3.50002 2.33335C3.50002 1.68902 2.97769 1.16669 2.33335 1.16669C1.68902 1.16669 1.16669 1.68902 1.16669 2.33335C1.16669 2.97769 1.68902 3.50002 2.33335 3.50002Z" />
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.4166 1.75001C12.858 2.14403 12.2395 2.4454 11.585 2.64251C11.2337 2.23855 10.7668 1.95224 10.2474 1.8223C9.72807 1.69235 9.18135 1.72504 8.68119 1.91594C8.18103 2.10684 7.75157 2.44674 7.45089 2.88967C7.1502 3.33261 6.9928 3.8572 6.99998 4.39251V4.97584C5.97485 5.00242 4.95906 4.77506 4.04307 4.31402C3.12708 3.85297 2.33933 3.17254 1.74998 2.33334C1.74998 2.33334 -0.583354 7.58334 4.66665 9.91667C3.46529 10.7322 2.03415 11.141 0.583313 11.0833C5.83331 14 12.25 11.0833 12.25 4.37501C12.2494 4.21252 12.2338 4.05044 12.2033 3.89084C12.7987 3.30371 13.2188 2.56242 13.4166 1.75001Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__copyright">
            <p class="copyright">Copyright 2020 JAHIT.CO.ID</p>
        </div>
    </div>
`;
if (pathFooterAllowed.includes(window.location.pathname)) {
    document.querySelector("footer").innerHTML = footer;
} else {
    document.querySelector("footer").innerHTML = "";
}
