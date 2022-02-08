<x-employer-layout title="Employer Dashboard">
    <x-slot name="scripts">
        <script>
            const bgColors = ['bg-success', 'bg-orange', 'bg-primary', 'bg-danger', 'bg-purple', ]

            function changeBg() {
                let cards = [...document.querySelectorAll('.ibox.widget-stat')]
                let count = 0
                cards.forEach(card => {
                    $(card).addClass(bgColors[count])
                    count++;
                    if (count == bgColors.length) {
                        count = 0
                    }
                })
            }

        </script>

        <script>
            changeBg()

        </script>
    </x-slot>
    <div class="page-heading">
        <h1 class="page-title">Dashboard</h1>
    </div>
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="" class="text-white">
                    <div class="ibox color-white widget-stat">
                        <div class="ibox-body">
                            <h2 class="m-b-5 font-strong"> 20</h2>
                            <div class="m-b-5 text-uppercase">Total categories</div>

                            <div>
                                <small>View More</small><i class="fa fa-arrow-circle-o-right m-l-5"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>



    <x-slot name="styles">
        <style>
            .form-group label {
                text-transform: capitalize;
            }

            .ibox.widget-stat {
                border-radius: 6px;
                box-shadow: 0px 0px 30px #297dd473;
            }

        </style>
    </x-slot>

</x-employer-layout>
