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

    @include('includes.style')
    
    
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo.svg" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Rewards</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="page-content page-auth mt-6" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center justify-content-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <h2>
                            Memulai untuk jual beli <br />
                            dengan cara terbaru
                        </h2>
                        <form method="POST" action="{{ route('register') }}" class="mt-3">
                            @csrf
                            
                            <div class="form-group">
                                <label>Full Name</label>                                
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" aria-describedby="nameHelp" v-model="name" autofocus>
                                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" v-model="email" @change="checkEmailAvailibility()" :class="{ 'is_invalid' : this.email_unavailable }" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label>Store</label>
                                <p class="text-muted">
                                    Apakah anda juga ingin membuka toko?
                                </p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_store_open" id="openStoreTrue" v-model="is_store_open" :value="true" />
                                    <label class="custom-control-label" for="openStoreTrue" >Iya, boleh</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" name="is_store_open" id="openStoreFalse" v-model="is_store_open" :value="false" />
                                    <label makasih class="custom-control-label" for="openStoreFalse">Enggak, makasih</label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Store Name</label>
                                <input name="store_name" type="text" class="form-control" aria-describedby="storeHelp"/>
                            </div>
                            <div class="form-group" v-if="is_store_open">
                                <label>Kategori</label>
                                <select name="category_id" class="form-control">
                                    <option value="" disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">
                                Sign Up Now
                            </button>

                            <a type="submit" class="btn btn-outline-secondary btn-block mt-2" href="{{ route('login') }}">
                                Back to Sign In
                            </a>
                            
                        </form>
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
    @include('includes.script')
    <script src="/plugins/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: "#register",
            mounted() {
                AOS.init();
            },
            methods: {
                checkEmailAvailibility: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email,
                        }
                    })
                        .then(function (response) {
                            
                            if(response.data == 'available') {
                                self.$toasted.show(
                                    "Yeeii! Your email available, please fill the form and submit",
                                    {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                                self.email_unavailable = false;    
                            } else {
                                self.$toasted.error(
                                    "Sorry! Your email unavailable, please use another email",
                                    {
                                        position: "top-center",
                                        className: "rounded",
                                        duration: 5000,
                                    }
                                );
                                self.email_unavailable = true;
                            }
                        });
                }
            },
            data() {
                return {
                    name: "Angga Hazza Sett",
                    email: "kamujagoan@bwa.id",
                    password: "",
                    is_store_open: true,
                    store_name: "",
                    email_unavailable: false,
                }
            },
        });
    </script>
</body>
</html>
