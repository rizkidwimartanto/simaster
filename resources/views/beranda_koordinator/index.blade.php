@extends('layout/templateberanda_koordinator')
@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4 g-3">
            <div class="col-12">
                <div class="card card-md card-items-unit">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">UP3 Grobogan</h3>
                                <div class="markdown">
                                    All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                    <a href="https://tabler-icons.io" target="_blank" rel="noopener">tabler-icons.io</a>,
                                    download any of the 4637 icons in SVG, PNG or&nbsp;React and use them in your favourite
                                    design tools.
                                </div>
                                <div class="mt-3">
                                    <a href="https://tabler-icons.io" class="btn btn-primary" target="_blank"
                                        rel="noopener">Download icons</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-md card-items-unit-ulp">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">ULP Demak</h3>
                                <div class="markdown">
                                    All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                    <a href="https://tabler-icons.io" target="_blank" rel="noopener">tabler-icons.io</a>,
                                    download any of the 4637 icons in SVG, PNG or&nbsp;React and use them in your favourite
                                    design tools.
                                </div>
                                <div class="mt-3">
                                    <a href="https://tabler-icons.io" class="btn btn-primary" target="_blank"
                                        rel="noopener">Download icons</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-md card-items-unit-ulp">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">ULP Tegowanu</h3>
                                <div class="markdown">
                                    All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                    <a href="https://tabler-icons.io" target="_blank" rel="noopener">tabler-icons.io</a>,
                                    download any of the 4637 icons in SVG, PNG or&nbsp;React and use them in your favourite
                                    design tools.
                                </div>
                                <div class="mt-3">
                                    <a href="https://tabler-icons.io" class="btn btn-primary" target="_blank"
                                        rel="noopener">Download icons</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-md card-items-unit-ulp">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">ULP Purwodadi</h3>
                                <div class="markdown">
                                    All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                    <a href="https://tabler-icons.io" target="_blank" rel="noopener">tabler-icons.io</a>,
                                    download any of the 4637 icons in SVG, PNG or&nbsp;React and use them in your favourite
                                    design tools.
                                </div>
                                <div class="mt-3">
                                    <a href="https://tabler-icons.io" class="btn btn-primary" target="_blank"
                                        rel="noopener">Download icons</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-md card-items-unit-ulp">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <h3 class="h1">ULP Wirosari</h3>
                                <div class="markdown">
                                    All icons come from the Tabler Icons set and are MIT-licensed. Visit
                                    <a href="https://tabler-icons.io" target="_blank" rel="noopener">tabler-icons.io</a>,
                                    download any of the 4637 icons in SVG, PNG or&nbsp;React and use them in your favourite
                                    design tools.
                                </div>
                                <div class="mt-3">
                                    <a href="https://tabler-icons.io" class="btn btn-primary" target="_blank"
                                        rel="noopener">Download icons</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-card {
            background: #133E87;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-card::before {
            content: '\26A1';
            position: absolute;
            font-size: 80px;
            color: rgba(255, 255, 255, 0.1);
            top: -10px;
            left: -10px;
            width: 100%;
            height: 100%;
            background-repeat: repeat;
            background-size: 100px 100px;
            opacity: 0.2;
            pointer-events: none;
            z-index: 1;
        }

        .custom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .custom-card img {
            object-fit: cover;
            z-index: 2;
            position: relative;
        }

        .custom-card .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #c8e1ff;
            transition: color 0.3s ease;
            z-index: 2;
            position: relative;
        }

        .custom-card .card-text {
            color: #F3F3E0;
            z-index: 2;
            position: relative;
        }

        .custom-card .btn-details {
            transition: background-color 0.3s ease, color 0.3s ease;
            z-index: 2;
            position: relative;
        }

        .custom-card:hover .btn-details {
            background-color: #0056b3;
            color: #fff;
        }
    </style>

    <!-- Optional JavaScript for Additional Interactions -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Optional interaction: Animate button on hover
            const buttons = document.querySelectorAll('.btn-details');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    button.classList.add('animate__animated', 'animate__pulse');
                });
                button.addEventListener('mouseleave', () => {
                    button.classList.remove('animate__animated', 'animate__pulse');
                });
            });
        });
    </script>
@endsection
