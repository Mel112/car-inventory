<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
style="background-image: url('storage/landing.jpg'); background-size: cover; min-height: 100vh; position: relative;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="flex-shrink-0 flex items-center m-5">
            <img class="m-2" src="https://img.icons8.com/fluency/96/null/traffic-jam.png"/>
            <p class="m-2 lh-sm fs-1 text-left fw-bold">Car Inventory</p>
        </div>
        {{ $slot }}
    </div>
</div>
