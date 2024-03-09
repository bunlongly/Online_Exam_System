<x-layout>
  @include('partials._hero')
 

  <div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold my-4 text-center">Limkokwing Cambodia</h1>
    <p class="my-4">Limkokwing Cambodia is a 21st century specialist university that integrates academic learning with the latest industry knowledge. This ensures that graduating students are ready to face the demands of their chosen careers.</p>
    <div class="flex flex-wrap items-center mb-8">
      <div class="w-full lg:w-1/2">
        <img src="{{ asset('images/lim.building.jpeg') }}" alt="Limkokwing building" class="rounded shadow"/>
      </div>
      <div class="w-full lg:w-1/2 lg:pl-4 text-center lg:text-center">
        <h1 class="text-3xl font-bold mb-4">About Our Campus</h1>
        <p>The campus stimulates creative thinking and provides opportunities for the students talent development, skills acquisition, and personal and professional growth.</p>
        <p class="mt-4">Limkokwing Cambodia is located at Phnom Penh, the country capital. Our two buildings consist of classrooms, lecture halls, computer laboratories, and a multimedia library.
        </p>
      </div>
    </div>

  
    <div class="flex flex-wrap  mb-8">
      <div class="w-full lg:w-1/2  lg:pr-2 lg:order-1 text-center lg:text-left">
        <h2 class="text-2xl font-bold mb-4">Equipping Cambodians with digital skills and global knowledge</h2>
        <p>Limkokwing has brought to Cambodia a new education wave that provides the right kind of skills and knowledge for its people. The kind of innovative education that nurtures the inner talents, skills, and capabilities of students for the betterment of their future.</p>
        <p class="my-4">Digital skills are especially becoming very important as Cambodia begins to connect more actively with the global economy. With more investors expanding in Cambodia manufacturing and tourism industries, there will be a demand for graduates with skills in digital technology.</p>
      </div>
      <div class="w-full lg:w-1/2 lg:order-2">
        <img src="{{ asset('images/lim.library.png') }}" alt="Limkokwing library" class="rounded shadow"/>
      </div>
    </div>


    <div class="flex flex-wrap mb-8">
      <div class="w-full  lg:pr-2 ">
        <p>The University provides ample opportunities for individual development and accomplishments. Students are exposed to a global network of friends from other parts of the world and can build their contacts from there. The experience and expertise that they obtain through Limkokwing enables them to take their country to a higher playing field.</p>
        <p class="my-4">Limkokwing Cambodia, through Limkokwing Malaysia, also benefits from its International Advisory Board. Representation from world-class universities provides direction that match world standards, worldwide recognition, and enables global transferability. The Limkokwing University is supported by a global network of 100 universities and knowledge centres.</p>
      </div>
    </div>

    <div class="container mx-auto text-center py-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      
        <div>
          <a>
            <i class="fas fa-envelope  text-teal text-3xl"></i>
            <p class="text-laravel text-2xl mt-2">contact@limkokwing.edu</p>
          </a>
        </div>
        
       
        <div>
          <i class="fab fa-linkedin text-teal text-3xl"></i>
          <p class="text-laravel text-2xl mt-2">LinkedIn</p>
        </div>
        
       
        <div>
          <i class="fas fa-phone-alt text-lg text-3xl text-teal"></i>
          <p class="text-laravel text-2xl mt-2">+855 23 999 333</p>
        </div>
      </div>
    </div>
    
    

</x-layout>
