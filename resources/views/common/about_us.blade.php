@extends('layouts.app')

@section('title', 'О проекте | Сказокнет')

@section('content')
    <div class="my-6 xl:container px-12 xl:px-4 mx-0 xl:mx-auto md:flex hidden items-center">
        <span class="text-sm xl:text-xs tracking-widest cursor-pointer">Главная</span>
        <span class="px-2">|</span>
        <span class="text-sm xl:text-xs tracking-widest text-primary">
            О проекте</span>
    </div>

    <div class="my-12 md:my-20 xl:container px-8 xs:px-12 xl:px-4 mx-0 xl:mx-auto relative">
        <div class="flex gap-4">
            <div class="w-full md:w-[60%] flex flex-col gap-10">
                <h1 class="font-bold text-xl md:text-2xl lg:text-4xl tracking-widest text-text w-[80%]">
                    СказокНет — онлайн-платформа где люди публикуют отзывы без иллюзий
                </h1>
                <span class="text-sm md:text-base text-text2 tracking-wide">Забудьте о сказках, выбирайте с
                    уверенностью.</span>
                <div class="w-[30%] h-[2px] bg-auth-input-border-color"></div>
                <span class="text-sm md:text-base text-text2 tracking-wide">Официальные редставители застройщиков оперативно
                    помогают на
                    платформе СказокНет решить любые вопросы прямо в отзывах
                    недовольных клиентов.</span>
                @if (!@auth()->user())
                    <a href="{{ route('register') }}"
                        class="text-center flex justify-center items-center md:w-fit w-full h-12.5 rounded-3xl border border-primary text-primary text-sm font-bold tracking-wide px-8 hover:bg-primary hover:text-white transition-colors cursor-pointer">
                        Зарегистрироваться
                    </a>
                @endif
            </div>
            <div class="md:w-[40%] hidden md:flex items-center justify-center">
                <img class="w-full h-auto max-w-[26.25rem] max-h-[25rem] min-h-[21.875rem]"
                    src="{{ asset('images/Group 456.png') }}" alt="" />
            </div>
        </div>
        <div class="mt-6">
            <h1 class="font-bold text-xl md:text-2xl lg:text-4xl tracking-widest text-text">
                О проекте
            </h1>
            <div class="flex flex-col gap-8 mt-8">
                {{-- <p class="text-sm md:text-base text-text2 tracking-wide">
                    Мы много лет работаем в области информационных технологий и
                    занимаемся только одним направлением - разработкой и поддержкой
                    крупнейшего сайта отзывов в российском сегменте Интернета. Однако,
                    в этом направлении мы сумели добиться существенных успехов,
                    благодаря команде талантливых программистов, системных
                    администраторов, менеджеров и всех остальных сотрудников.
                </p>
                <p class="text-sm md:text-base text-text2 tracking-wide">
                    Миллионы пользователей на Отзовике ежедневно читают и публикуют
                    отзывы обо всем на свете. В базе данных сервиса накопилось уже
                    более 15 млн. отзывов и 44 млн. комментариев, а ежемесячная
                    аудитория ~ 25 миллионов пользователей. На Отзовике активно
                    используются передовые технологии и технические решения для
                    обеспечения надежности и безопасности нашего сервиса и его
                    пользователей. Мы применяем уникальные практики для работы с
                    высоконагруженными системами и обработки больших объемов текстовой
                    и графической информации. Использование реплицируемого кластера
                    MySQL с доработками позволяет добиваться Uptime наших серверов в
                    99.9% более 10 лет! Элементы искусственного интеллекта и сложных
                    алгоритмических структур дают возможность на очень высоком уровне
                    выявлять фейки и сгенерированные отзывы.
                </p>
                <p class="text-sm md:text-base text-text2 tracking-wide">
                    Наша миссия заключается в обеспечении возможностей для любого
                    потребителя получить честные отзывы на интересующие товары/услуги
                    и помочь принять правильное решение перед покупкой, а для
                    производителей и предпринимателей - своевременно обнаруживать
                    возможные проблемы в бизнесе и постоянно совершенствоваться. Мы
                    стремимся создать максимально удобный и функциональный сервис для
                    наших пользователей, чтобы каждый мог легко и быстро найти
                    необходимую информацию, оставить честный отзыв из личного опыта и
                    получить необходимую помощь от официальных представителей компаний
                </p> --}}
                @if ($data != null)
                    {!! $data->text !!}
                @endif
                <p class="text-sm md:text-base text-text2 tracking-wide">
                    Наш сервис всегда открыт для
                    <a href="#" class="text-primary">обратной связи, пожеланий и отзывов.</a>
                </p>
            </div>
        </div>

        <button
            class="absolute right-12 top-4 z-10 rounded-full px-2 py-1 bg-custom-gray-2 cursor-pointer text-white md:hidden block">
            <i class="mdi mdi-chevron-left"></i>
        </button>
        <div class="md:hidden absolute left-0 top-0 z-[-1] size-full flex justify-center">
            <img src="{{ asset('images/Group 2344.png') }}" class="w-full max-w-[25rem] h-auto max-h-[31rem] min-h-[31rem]"
                alt="" />
        </div>
    </div>
@endsection
