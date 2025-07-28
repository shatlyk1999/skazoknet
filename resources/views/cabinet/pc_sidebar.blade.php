 <div class="max-w-[15.625rem] xl:max-w-[21.875rem] w-full bg-primary fixed top-0 left-0 h-dvh md:block hidden">
     <a href="{{ route('home') }}" class="mt-12 flex items-center justify-center">
         <img src="{{ asset('images/logo.png') }}" class="h-10" alt="" />
     </a>
     <div class="relative h-[calc(100%-5.5rem)] flex flex-col justify-between overflow-auto" style="padding-top: 50px">
         <div>
             <a href="{{ route('userProfile', auth()->user()->id) }}"
                 class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                 <div class="flex items-center justify-between">
                     <span>Мой профиль</span>
                 </div>
             </a>
             <a href="#"
                 class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                 <div class="flex items-center justify-between">
                     <span>Мои отзывы</span>
                     <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">15</span>
                 </div>
             </a>
             @if (auth()->user()->role == 'developer' || auth()->user()->role == 'superadmin')
                 <a href="#"
                     class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>О компании</span>
                     </div>
                 </a>
                 <a href="#"
                     class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>Мои комплексы</span>
                         <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">15</span>
                     </div>
                 </a>
                 <a href="#"
                     class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>Всего отзывов</span>
                         <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">15</span>
                     </div>
                 </a>
             @endif
             <a href="#"
                 class="border-b border-b-transparent text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                 <div class="flex items-center justify-between">
                     <span>Мои сообщения</span>
                     <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">+10</span>
                 </div>
             </a>
         </div>
         <div class="pb-6 pl-6">
             <form action="{{ route('logout') }}" class="sidebar-link flex" method="post">
                 @csrf
                 <img src="{{ asset('icons/logout.svg') }}" alt="" />
                 <button type="submit"
                     class="border-none bg-transparent text-white outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                     Выйти
                 </button>
             </form>
         </div>
     </div>
 </div>
