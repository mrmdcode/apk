let userList = $('#userList');
let baseUrl = '/dashboard/admin/messages';
let selectedUser ;
const csrf = $('input[name="_token"]').val()

const init = async () => {

    let initData = await fetch(`${baseUrl}/init`);
    let data = await initData.json();
    // console.log(data)
    data.Users.map((user)=>{
        userList.append( `
                <li class="clearfix" id="user_${user.id}_selector" onclick="selectUser(${user.id})">
                    <img src="/${user.logo}" alt="avatar">
                    <div class="about">
                        <div class="name">${user.name}</div>
                    </div>
                </li>
`)
    });
}


const scrollToEnd = () => {
    // chatContainer = $('#chatBox');
    // chatContainer.scrollTop(chatContainer.prop('scrollHeight'));

}


const selectUser = async (id) => {
    selectedUser = id;
    $('li').removeClass('active');
    $(`#user_${id}_selector`).addClass('active');
    $('#sendButton').attr('disabled',false);
    messages = await fetch(`${baseUrl}/giveMessages/${id}`);
    messages = await messages.json();
    // console.log(messages)
    $('#userSelectedLogo').attr('src',`/${messages.user.company_logo}`)
    $('#userSelectedName').text(messages.user.company_name);
    $('#chatBox').html(messages.messages.map((item)=>{
        // console.log(item)
        if (item.company_sender == id)
            return(`
                <li class="clearfix">
                    <div class="message-data text-right">
                        <span class="message-data-time">${timeConvertor(item.created_at)}</span>
                    </div>
                    <div class="message other-message float-right">${item.message} </div>
                </li>
            `)
        else
            return(`
                    <li class="clearfix">
                        <div class="message-data">
                            <span class="message-data-time">${timeConvertor(item.created_at)}</span>
                        </div>
                        <div class="message my-message">${item.message}</div>
                    </li>
            `)

    }).join(' '));
    // console.log($("#chatBox")[0].scrollHeight,$("#chatBox")[0].scrollTop)
    // $("#chatBox")[0].scrollTop = 199;

}


$('#sendButton').click(()=> {
    if (!!$('#inputMessage').val()){
        messSend(selectedUser,$('#inputMessage').val())
        selectUser(selectedUser);
        $('#inputMessage').val(null);
    }
})


const messSend = async (targetId,message) => {
    const raw = JSON.stringify({
        targetId : targetId,
        message:message
    });
    const headers = {
        "Content-type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN":csrf,
    };
    mess = await fetch(`${baseUrl}/sendMessages/${targetId}`,{
        method:'POST',
        headers:headers,
        body:raw,
    })
    return mess;
}




const timeConvertor = (dateTimeString) => {
    const date = new Date(dateTimeString);

    const day = date.toLocaleDateString('fa-IR', { weekday: 'long' });
    const hour = date.toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit' });

    return day+' '+hour;
}

init();
