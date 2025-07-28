 <!-- Sidebar -->
 {{-- <div id="adminOverlay"
     class="fixed inset-0 bg-black opacity-0 pointer-events-none transition-opacity duration-300 ease-in-out z-20"></div> --}}
 <div id="adminSidebar"
     class="admin-sidebar fixed top-0 h-full w-full bg-primary text-white transition-all duration-300 ease-in-out z-30 rounded-r-lg shadow-lg block md:hidden"
     role="navigation">
     <div class="flex justify-end p-4 relative">
         <button id="closeAdminSidebar"
             onclick="toggleSidebar('adminToggle', 'adminSidebar', 'adminOverlay', 'closeAdminSidebar')"
             class="text-white text-2xl hover:rotate-90 hover:bg-white/10 px-1 rounded-full transition-all duration-200 border border-white"
             aria-label="Close menu">
             <i class="mdi mdi-close"></i>
         </button>
         <div class="absolute z-[-1] top-0 left-1/2 -translate-x-1/2 h-full w-full flex items-center justify-center">
             <img src="{{ asset('images/logo.png') }}" alt="" />
         </div>
     </div>
     <div class="relative px-4 h-[calc(100%-5.5rem)] pt-[12rem] flex flex-col justify-between overflow-auto">
         <div>
             <a href="#"
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
             <a href="#"
                 class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                 <div class="flex items-center justify-between">
                     <span>Мои комплексы</span>
                     <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">15</span>
                 </div>
             </a>
             @if (auth()->user()->role == 'developer' || auth()->user()->role == 'superadmin')
                 <a href="#"
                     class="border-b border-b-transparent text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>Мои сообщения</span>
                         <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">+10</span>
                     </div>
                 </a>
                 <a href="#"
                     class="border-b border-white text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>О компании</span>
                     </div>
                 </a>
                 <a href="#"
                     class="border-b border-b-transparent text-white font-semibold text-base inline-block w-full py-3 xl:py-4 px-6">
                     <div class="flex items-center justify-between">
                         <span>Всего отзывов</span>
                         <span class="py-1 xl:py-2 px-3 xl:px-4 rounded-xl bg-white text-primary">+10</span>
                     </div>
                 </a>
             @endif
         </div>
         <div class="pb-6 pl-6 flex items-center justify-center">
             <button
                 class="border-none bg-transparent text-white outline-none hover:bg-black/5 transition-colors p-2 rounded-lg text-lg flex items-center gap-x-2">
                 <img src="{{ asset('icons/logout.svg') }}" alt="" />
                 Войти
             </button>
         </div>
     </div>
 </div>
 <!-- Sidebar -->
