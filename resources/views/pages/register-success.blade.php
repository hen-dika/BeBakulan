<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Store - Your Best Marketplace</title>

    @include('includes.app.style')
</head>

<body>
 <!-- Page Content -->
 <div class="page-content page-success">
    <div class="section-success" data-aos="zoom-in">
        <div class="container">
            <div class="row align-items-center row-login justify-content-center">
                <div class="col-lg-6 text-center">
                    <img src="/images/success.svg" alt="" class="mb-4" />
                    <h2>
                        Welcome to Store
                    </h2>
                    <p>
                        Kamu sudah berhasil terdaftar <br />
                        bersama kami. Let’s grow up now.
                    </p>
                    <div>
                        <a class="btn btn-success w-50 mt-4" href="/dashboard.html">
                            My Dashboard
                        </a>
                        <a class="btn btn-signup w-50 mt-2" href="/index.html">
                            Go To Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="pt-4 pb-2">
                    2019 Copyright Store. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
@include('includes.app.script')
</body>
</html>
