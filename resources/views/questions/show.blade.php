@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                    <a href="{{ route('questions.index') }}" class="btn btn-outline-primary">Back to all questions</a>   
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            @include('shared._vote', [
                                'model' => $question,
                            ])

                            @include('shared._favorite', [
                                'question' => $question,
                            ])
                        </div>

                        <div class="media-body">
                            {!! $question->bodyHTML !!}
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    {{-- @include('shared._author', [
                                        'label' => 'asked',
                                        'model' => $question,
                                    ]) --}}

                                    <user-info :model="{{ $question }}" label="Asked"></user-info>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count
    ])

    @include('answers._create')
</div>
@endsection

{{-- <user-info :model={&quot;id&quot;:12,&quot;title&quot;:&quot;Aut sed officiis aut vero quia&quot;,&quot;slug&quot;:&quot;aut-sed-officiis-aut-vero-quia&quot;,&quot;body&quot;:&quot;** Inventore** et et veritatis accusantium recusandae minima a. Et eligendi dicta dolor saepe quia omnis. Sunt et dolor eos accusamus ullam. Ea qui voluptate hic non itaque est recusandae.\r\n\r\nVoluptatum ullam facilis sint at id ea ducimus. Numquam veniam impedit et architecto et. Earum qui tenetur deleniti. Ut nisi rerum dolorem quis aut. Blanditiis accusamus et aut est sed est.\r\n\r\nQuis ipsum sunt et qui dignissimos a eveniet id. Velit deserunt eaque sed rerum. Quidem consequuntur corporis hic quia.\r\n\r\nVoluptatum consequatur omnis voluptas voluptates. Repellat ratione libero eius velit. Doloribus magni eos mollitia quia totam.\r\n\r\nSapiente ut explicabo similique aut. A quas quidem eaque neque illum voluptatem voluptas. Ipsa deserunt architecto quasi aliquid voluptatem veniam eveniet sit.\r\n\r\nInventore sit at sed sunt. Nulla ullam quidem omnis nulla. Delectus explicabo iusto reiciendis cupiditate repudiandae.\r\n\r\nEos iusto excepturi quis eum non id. Vero quia est error earum debitis adipisci sapiente. Pariatur dignissimos consequatur quasi labore est nostrum et fuga. Rerum ullam voluptatem eligendi neque quos enim. Quia ea repellendus incidunt vel libero.&quot;,&quot;views&quot;:101,&quot;answers_count&quot;:4,&quot;votes_count&quot;:2,&quot;best_answer_id&quot;:32,&quot;user_id&quot;:4,&quot;created_at&quot;:&quot;2019-10-21 15:33:04&quot;,&quot;updated_at&quot;:&quot;2019-11-12 14:52:23&quot;,&quot;answers&quot;:[{&quot;id&quot;:34,&quot;question_id&quot;:12,&quot;user_id&quot;:4,&quot;body&quot;:&quot;gserg&quot;,&quot;votes_count&quot;:1,&quot;created_at&quot;:&quot;2019-11-07 09:37:44&quot;,&quot;updated_at&quot;:&quot;2019-11-07 09:41:23&quot;,&quot;user&quot;:{&quot;id&quot;:4,&quot;name&quot;:&quot;Mr. Monty Champlin PhD&quot;,&quot;email&quot;:&quot;olson.hadley@example.net&quot;,&quot;email_verified_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;created_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;updated_at&quot;:&quot;2019-10-21 15:33:01&quot;}},{&quot;id&quot;:23,&quot;question_id&quot;:12,&quot;user_id&quot;:3,&quot;body&quot;:&quot;Mollitia nostrum voluptatem ullam neque harum dolore. Reprehenderit ab ipsum dolores fugiat aut molestiae. Similique debitis labore dignissimos dolorem laborum ea modi. Nulla occaecati fuga et.\n\nModi ad velit ex id beatae quis. Quia eius nihil voluptate repudiandae voluptas doloremque. Minima fugiat quia sint ipsum. Aut provident sit a. Qui unde dolorum commodi omnis exercitationem.\n\nTempora voluptas non dolores nam at sit. Est veritatis quas doloremque dicta. Ut quo qui vitae pariatur. In cumque tempora necessitatibus recusandae consectetur.\n\nId voluptas commodi a et est tenetur autem. Voluptas ut voluptatem non blanditiis delectus. Cum dolore dolor omnis fugit dolor minima molestiae. Dignissimos dolore rem quidem deserunt.\n\nUt minus placeat sed alias necessitatibus ducimus ut. Quia aperiam recusandae ea explicabo. Quam repellat nihil laboriosam culpa a qui recusandae.\n\nIn voluptatem sit provident aut explicabo sint. Qui totam modi repudiandae harum corporis. Quisquam qui inventore quaerat perferendis reiciendis aut illum voluptates.&quot;,&quot;votes_count&quot;:0,&quot;created_at&quot;:&quot;2019-10-21 15:33:04&quot;,&quot;updated_at&quot;:&quot;2019-11-07 09:41:02&quot;,&quot;user&quot;:{&quot;id&quot;:3,&quot;name&quot;:&quot;Chaz Thiel&quot;,&quot;email&quot;:&quot;brain82@example.org&quot;,&quot;email_verified_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;created_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;updated_at&quot;:&quot;2019-10-21 15:33:01&quot;}},{&quot;id&quot;:24,&quot;question_id&quot;:12,&quot;user_id&quot;:3,&quot;body&quot;:&quot;Adipisci hic aliquid qui maxime quaerat ad. Et quis quia sunt voluptas enim. Quaerat consectetur laborum nobis recusandae nulla consequatur eum. Voluptate nam veritatis voluptatum minima velit possimus architecto.\n\nIpsam reiciendis non officia asperiores ab magni distinctio. Ducimus ut placeat et sed in et nulla repellendus. Consequatur saepe hic reiciendis numquam.\n\nQuod unde quia officiis libero eius. Dolorem adipisci deleniti magnam. Praesentium et quaerat eius qui sit eos aut. Sint et est ad facere culpa id ad.\n\nQuaerat aut tenetur ex et. Voluptatem pariatur ipsam temporibus ab vel quasi. Error enim voluptas ad iste odio quibusdam eum et. Expedita natus sit animi sunt magni esse.\n\nPerspiciatis illum ut nostrum veritatis rerum ipsa doloremque. Quas dolorem assumenda molestiae beatae soluta assumenda assumenda.\n\nDolor rerum quia quae iusto dignissimos. Ea voluptatem ducimus et sequi porro aut. Consequuntur facere corporis beatae harum et.&quot;,&quot;votes_count&quot;:0,&quot;created_at&quot;:&quot;2019-10-21 15:33:04&quot;,&quot;updated_at&quot;:&quot;2019-11-07 09:41:18&quot;,&quot;user&quot;:{&quot;id&quot;:3,&quot;name&quot;:&quot;Chaz Thiel&quot;,&quot;email&quot;:&quot;brain82@example.org&quot;,&quot;email_verified_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;created_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;updated_at&quot;:&quot;2019-10-21 15:33:01&quot;}},{&quot;id&quot;:32,&quot;question_id&quot;:12,&quot;user_id&quot;:1,&quot;body&quot;:&quot;this is my answer&quot;,&quot;votes_count&quot;:0,&quot;created_at&quot;:&quot;2019-10-21 15:34:04&quot;,&quot;updated_at&quot;:&quot;2019-11-03 06:53:37&quot;,&quot;user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;Unique Bode PhD&quot;,&quot;email&quot;:&quot;lourdes13@example.net&quot;,&quot;email_verified_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;created_at&quot;:&quot;2019-10-21 15:33:01&quot;,&quot;updated_at&quot;:&quot;2019-10-21 15:33:01&quot;}}]} :label='Asked'></user-info> --}}