/* console.log('hola mundo'); */
let id_usuario = userId;
let id_usuario_receptor;

let data = [];
let messages = [];
let allBotones = document.querySelectorAll('.friend_btn');
allBotones.forEach(btn => {
    btn.addEventListener('click', () => {
        id_usuario_receptor = btn.getAttribute('data-id');

        let chat = document.getElementById('chat');
        if (chat) {
            actualizarDatos()
            //cambiar sus datos
        } else {
            // crear chat
            const chatDiv = document.createElement('div');
            chatDiv.id = 'chat';
            chatDiv.className = 'absolute left-0 bottom-0 w-full max-w-md mx-auto bg-white shadow-lg rounded-lg flex flex-col h-[600px]';

            const contactUsernameDiv = document.createElement('div');
            contactUsernameDiv.id = 'contact_username';
            contactUsernameDiv.className = 'bg-blue-500 text-white font-bold text-lg p-4 rounded-t-lg';
            chatDiv.appendChild(contactUsernameDiv);

            const messageAreaDiv = document.createElement('div');
            messageAreaDiv.id = 'message_area';
            messageAreaDiv.className = 'flex-1 overflow-y-auto p-4 space-y-3 bg-gray-100';
            chatDiv.appendChild(messageAreaDiv);

            const formElement = document.createElement('form');
            formElement.id = 'chatForm';
            formElement.method = 'POST';
            formElement.action = 'http://localhost/2DAW/Practica6-blog/messages/create';
            formElement.className = 'flex items-center border-t p-3 bg-gray-50';

            const inputElement = document.createElement('input');
            inputElement.id = 'text';
            inputElement.type = 'text';
            inputElement.name = 'message';
            inputElement.placeholder = 'Escribe un mensaje...';
            inputElement.className = 'flex-1 px-4 py-2 border rounded-lg outline-none focus:ring-2 focus:ring-blue-500';
            formElement.appendChild(inputElement);

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'id_receptor';
            hiddenInput.value = id_usuario_receptor;
            formElement.appendChild(hiddenInput);

            const sendButton = document.createElement('button');
            sendButton.id = 'sendButton';
            sendButton.className = 'ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition';
            sendButton.textContent = 'Enviar';
            formElement.appendChild(sendButton);
            sendButton.addEventListener('click',(e)=>{
                e.preventDefault();
                let formElement = document.getElementById('chatForm');
                let formData = new FormData(formElement);
                fetch(formElement.action, {
                    method: 'POST',
                    body: formData  
                })
                .then(()=>{
                    document.getElementById('text').value = '';
                    actualizarDatos();
                })
                
                
                
            },false);


            chatDiv.appendChild(formElement);
            document.getElementById('main').appendChild(chatDiv);
            actualizarDatos()
        }
    }, false);
});

function imprimirDatos() {

}

async function actualizarDatos() {
    try {
        let userDataResponse = await fetch(`index.php?id_receptor=${id_usuario_receptor}`);
        data = await userDataResponse.json();
        
        let userChatMessagesResponse = await fetch(`index.php?id_receptor=${id_usuario_receptor}&id_usuario=${id_usuario}`);
       
        let messages = await userChatMessagesResponse.json();     
        let message_area = document.getElementById('message_area');
        message_area.innerHTML = "";
        messages.forEach(message => {
            console.log(message);
            const messageDiv = document.createElement('div');
            if (message['chats_user1_id'] == id_usuario) {
                messageDiv.className = 'place-self-end bg-blue-500 text-white p-2 rounded-lg max-w-xs m-2';
            } else {
                messageDiv.className = 'place-self-start bg-green-500 text-white p-3 rounded-lg max-w-xs';
            }
            messageDiv.innerText = message['message'];
            message_area.appendChild(messageDiv);
        });


        document.getElementById('contact_username').innerText = data['username'];
    } catch (error) {

    }

}