<div style="background-color:rgb(93, 187, 116)"
   x-data="{type:'all',query:@entangle('query')}"
   x-init="

   setTimeout(()=>{

    conversationElement = document.getElementById('conversation-'+query);


    //scroll to the element

    if(conversationElement)
    {

        conversationElement.scrollIntoView({'behavior':'smooth'});

    }

    },200);



    Echo.private('users.{{Auth()->User()->id}}')
    .notification((notification)=>{
        if(notification['type']== 'App\\Notifications\\MessageRead'||notification['type']== 'App\\Notifications\\MessageSent')
        {

            window.Livewire.emit('refresh');
        }
    });
   
   "
 class="flex flex-col transition-all h-full overflow-hidden">
 @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp
    <header style="background-color: rgb(31, 122, 54)"  class="px-3 z-10 bg-white sticky top-0 w-full py-2">

    <div class="border-b justify-between flex items-center pb-2">

<div class="flex items-center gap-2">
<form "
action="{{ 
$profileData->role == 'admin' ? route('admin.dashboard') : 
($profileData->role == 'collage_registral' ? route('collageregistral.dashboard') : 
($profileData->role == 'collage_dean' ? route('collagedean.dashboard') : 
($profileData->role == 'department_head' ? route('departmenthead.dashboard') : 
($profileData->role == 'stuff' ? route('stuff.dashboard') : '#'))))
}}" 
method="get"
>
<button 
style=" font-size:20px; font-weight:bold; border-color: green;" 
type="submit" 
class="btn btn-outline-success inline-flex justify-center items-center  gap-x- text-sm lg:text-lg font-medium px-4 lg:px-8 py-2 lg:py-3 border border-green-500 text-green-600 bg-gradient-to-r from-green-100 to-white shadow-md hover:from-green-200 hover:to-green-100 hover:text-green-700 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105"
aria-label="Add users to my Chatlist"
>
HOME
</button>
</form>


</div>

 <button>

    <svg class="w-7 h-7"  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
      </svg>

 </button>

</div>


        {{-- Filters --}}

        <div style="background-color: rgb(191, 200, 218)" >

   
            <form action="{{ route('users') }}" method="get">
            <button 
                style="color:rgb(10, 21, 46); font-size:20px; font-weight:bold; border-color: green;" 
                type="submit" 
                class="btn btn-outline-success inline-flex justify-center items-center rounded-full gap-x-2 text-sm lg:text-lg font-medium px-4 lg:px-6 py-1 lg:py-1 border border-green-500 text-green-600 bg-gradient-to-r from-green-100 to-white shadow-md hover:from-green-200 hover:to-green-100 hover:text-green-700 hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                aria-label="Add users to my Chatlist">
                Add users to my Chatlist
            </button>
            </form>


        </div>

    </header>


    <main class=" overflow-y-scroll overflow-hidden grow  h-full relative " style="contain:content">

        {{-- chatlist  --}}

        <ul class="p-2 grid w-full spacey-y-2">

            @if ($conversations)
                
            @foreach ($conversations as $key=> $conversation)
                
           
            <li
              id="conversation-{{$conversation->id}}" wire:key="{{$conversation->id}}"
             class="py-3 hover:bg-gray-50 rounded-2xl dark:hover:bg-gray-700/70 transition-colors duration-150 flex gap-4 relative w-full cursor-pointer px-2 {{$conversation->id==$selectedConversation?->id ? 'bg-gray-100/70':''}}">
<a href="#" class="shrink-0" style="position: relative;">
    <x-avatar src="{{ !empty($conversation->getReceiver()->photo) ? url('upload/admin_image/'.$conversation->getReceiver()->photo) : url('upload/no_image.jpg') }}" />
    
    @if(empty($conversation->getReceiver()->photo))
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-weight: bold; pointer-events: none; text-transform: uppercase;">
            {{ substr(optional($conversation->getReceiver())->name, 0, 1) }}
        </div>
    @endif
</a>

                <aside class="grid grid-cols-12 w-full">

                    <a href="{{route('chat',$conversation->id)}}" class="col-span-11 border-b pb-2 border-gray-200 relative overflow-hidden truncate leading-5 w-full flex-nowrap p-1">

                        {{-- name and date  --}}
                        <div class="flex justify-between w-full items-center">

                            <h6 style="font-size:15px;font-weight:bold" class="truncate font-medium tracking-wider text-gray-900">
                                {{$conversation->getReceiver()->name}}
                            </h6>

                            <small class="text-gray-700">{{$conversation->messages?->last()?->created_at?->shortAbsoluteDiffForHumans()}} </small>

                        </div>

                        {{-- Message body --}}


                        <div class="flex gap-x-2 items-center">

                            @if ($conversation->messages?->last()?->sender_id==auth()->id())



                            @if ($conversation->isLastMessageReadByUser())
                                      {{-- double tick  --}}
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                                    <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"/>
                                    <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"/>
                                  </svg>
                            </span>
                            @else

                                    {{-- single tick  --}}
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                        </svg>
                                    </span>
                                    
                            @endif
                            @endif
                      

                   

                             <p class="grow truncate text-sm font-[100]">
                               {{$conversation->messages?->last()?->body??' '}}
                            </p>

                             {{-- unread count --}}
                             @if ($conversation->unreadMessagesCount()>0)
                             <span class="font-bold p-px px-2 text-xs shrink-0 rounded-full bg-blue-500 text-white">
                                {{$conversation->unreadMessagesCount()}}
                             </span>
                                 
                             @endif


                        </div>



                    </a>

                    {{-- Dropdown --}}

                    <div class="col-span-1 flex flex-col text-center my-auto">

                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical w-7 h-7 text-gray-700" viewBox="0 0 16 16">
                                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                      </svg>
                               

                                </button>
                            </x-slot>
        
                            <x-slot name="content">

                                <div class="w-full p-1">

                                    <button class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100">

                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                              </svg>
                                        </span>

                                        View Profile

                                    </button>
                                    <button 
                                    onclick="confirm('Are you sure?')||event.stopImmediatePropagation()"
                                    wire:click="deleteByUser('{{encrypt($conversation->id)}}')"
                                    class="items-center gap-3 flex w-full px-4 py-2 text-left text-sm leading-5 text-gray-500 hover:bg-gray-100 transition-all duration-150 ease-in-out focus:outline-none focus:bg-gray-100">

                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                              </svg>
                                        </span>

                                        Delete

                                    </button>



                                </div>
                     
                            </x-slot>
                        </x-dropdown>



                    </div>


                </aside>

            </li>
            @endforeach

            @else
                
            @endif

        </ul>

    </main>
</div>
