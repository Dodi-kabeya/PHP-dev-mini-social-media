
var chats = document.querySelector('.chats');

var chat = document.querySelector('#message');

var send = document.querySelector('#send');

var file = document.querySelector('.file');


send.addEventListener('click', (e)=>{
    e.preventDefault();
    
    var conversation = document.createElement('li');

    conversation.classList.add('chatting');

    conversation.innerHTML = chat.value;

    chats.appendChild(conversation);

    chat.value = " ";
});
