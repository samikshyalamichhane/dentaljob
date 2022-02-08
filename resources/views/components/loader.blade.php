<span class="loader__wrapper">
    <div class="loader__container"></div>
    <div class="loader__container"></div>
    <div class="loader__container"></div>
    <div class="loader__container"></div>
</span>
@push('styles')
    <style>
        .loading {
            position: absolute;
            left: 50%;
            top: 40%;
            transform: translate(-50%, -50%);
        }

        .loader__overlay__box {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99999999;
            background: rgba(0, 0, 0, 0.4);
            width: 100%;
            height: 100%;
            display: block;
        }

        h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 4em;
            text-align: center;
            letter-spacing: -10px;
            font-weight: lighter;
        }

        h1 span {
            color: #fff;
        }

        .loader__wrapper {
            display: block;
            width: 122px;
            margin: 50px auto;
        }

        .loader__container {
            height: 20px;
            width: 20px;
            position: absolute;
            border-radius: 50%;
            background: #000;
            display: inline-block;
        }

        .loader__container:first-child {
            animation: move 1s ease-in-out infinite alternate;
            background: #fff;
            margin-left: 0;
        }

        .loader__container:nth-child(2) {
            animation: move 1s ease-in-out -0.25s infinite alternate;
            margin-left: 35px;
            background: #fff;
        }

        .loader__container:nth-child(3) {
            animation: move 1s ease-in-out -0.5s infinite alternate;
            margin-left: 70px;
            background: #fff;
        }

        .loader__container:nth-child(4) {
            animation: move 1s ease-in-out -0.75s infinite alternate;
            margin-left: 105px;
            background: #fff;
        }

        @-moz-keyframes move {
            0% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(5px);
            }
        }

        @-webkit-keyframes move {
            0% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(5px);
            }
        }

        @-o-keyframes move {
            0% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(5px);
            }
        }

        @keyframes move {
            0% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(5px);
            }
        }

    </style>
@endpush
