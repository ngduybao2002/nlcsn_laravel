<!DOCTYPE html>
<html>

@include('components.header-homepage')

<body class="text-gray-800 antialiased">
    @include('components.nav-homepage')
    <main >
        <section class="relative block" style="height: 400px;">
            <div class="absolute top-0 w-full h-full bg-center bg-cover bg-gray-300">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-black"></span>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-gray-300 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <section class="relative py-16 bg-gray-300">
            <div class="container mx-auto px-4">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg -mt-64">
                    <div class="px-6">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                                <div class="relative pb-20">
                                    <img src="{{ asset('images/posts/'.$postDetails->picture) }}" alt="{{ $postDetails->picture }}" class="-m-16 mx-auto" />
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-800">
                                {{ ($postDetails->title) }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                                <i class="fas fa-calendar mr-2 text-lg text-gray-500"></i>
                                {{ \Carbon\Carbon::parse($postDetails->updated_at)->format('d-m-Y') }}
                            </div>
                            <div class="mb-2 text-gray-700">
                                Posted by: {{ ($postDetails->user->name) }}
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-gray-300 text-left">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <div class="mb-4 leading-relaxed text-gray-800">
                                        {!! $postDetails->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <button id="back-to-top" class="fixed bottom-5 right-5 bg-blue-500 text-white p-2 rounded-full hidden">
        <i class="fas fa-arrow-up"></i>
    </button>
</body>

</html>
