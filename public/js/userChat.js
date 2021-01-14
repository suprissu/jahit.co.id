const dateFormat = (date) => {
    const options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    return date.toLocaleDateString("id-ID", options);
};

const getChatProject = (chatId) => {
    const chat = chatProject.find(({ id }) => id == chatId);

    let messages = "";
    let perspectiveMessage;

    for (let i = chat.message.length - 1; i >= 0; i--) {
        if (chat.message[i].role === chat.userRole) {
            perspectiveMessage = "me";
        } else if (chat.message[i].role === "ADMIN") {
            perspectiveMessage = "admin";
        } else {
            perspectiveMessage = "other";
        }

        if (chat.message[i].type === "INISIASI") {
            if (chat.userRole === "CLIENT") {
                if (chat.message[i].answer === "reject") {
                    messages += initiationPartnerChat(
                        perspectiveMessage,
                        chat.message[i].answer,
                        chat.project.id,
                        chat.project.name,
                        chat.project.amount,
                        chat.customerId,
                        chat.partnerId,
                        chat.id,
                        chat.message[i].id
                    );
                }
                messages += initiationCustomerChat(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount
                );
            } else {
                messages += initiationPartnerChat(
                    perspectiveMessage,
                    chat.message[i].answer,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount,
                    chat.customerId,
                    chat.partnerId,
                    chat.id,
                    chat.message[i].id
                );
            }
        } else if (chat.message[i].type === "DIAJUKAN") {
            messages += proposeChat(
                perspectiveMessage,
                chat.project.id,
                chat.project.name,
                chat.project.amount,
                chat.message[i].negotiation.price,
                dateFormat(new Date(chat.message[i].negotiation.start_date)),
                dateFormat(new Date(chat.message[i].negotiation.end_date))
            );
        } else if (chat.message[i].type === "VERIFIKASI") {
            messages += verificationChat(
                perspectiveMessage,
                chat.transaction.id
            );
        } else if (chat.message[i].type === "VERIFIKASI DITOLAK") {
            messages += verificationRejectChat(
                perspectiveMessage,
                chat.transaction.id
            );  
        } else if (chat.message[i].type === "NEGOSIASI") {
            messages += negotiationChat(
                perspectiveMessage,
                chat.message[i].answer,
                chat.project.id,
                chat.project.name,
                chat.project.amount,
                chat.message[i].negotiation.price,
                dateFormat(new Date(chat.message[i].negotiation.start_date)),
                dateFormat(new Date(chat.message[i].negotiation.end_date)),
                chat.customerId,
                chat.partnerId,
                chat.id,
                chat.message[i].id,
                chat.message[i].negotiation.id 
            );
        } else if (chat.message[i].type === "SETUJU") {
            if (chat.userRole === "CLIENT") {
                messages += runProjectPermission(
                    chat.message[i].answer,
                    chat.project.id,
                    chat.partnerId,
                    chat.id,
                    chat.message[i].id,
                    chat.message[i].negotiation.id
                );
            }
            messages += negotiationAcceptChat(
                perspectiveMessage,
                chat.project.id,
                chat.project.name,
                chat.project.amount,
                chat.message[i].negotiation.price,
                dateFormat(new Date(chat.message[i].negotiation.start_date)),
                dateFormat(new Date(chat.message[i].negotiation.end_date))
            );
        } else if (chat.message[i].type === "SAMPLE") {
            if (chat.userRole === "CLIENT") {
                messages += customerAskSample(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerAskSample(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "SAMPLE TERKIRIM") {
            if (chat.userRole === "CLIENT") {
                messages += customerSampleDelivered(
                    perspectiveMessage,
                    chat.message[i].answer,
                    chat.project.id,
                    chat.partnerId,
                    chat.id,
                    chat.message[i].negotiation.id,
                    chat.message[i].id
                );
            } else {
                messages += partnerSampleDelivered(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name
                );
            }
        } else if (chat.message[i].type === "DEAL") {
            if (chat.userRole === "CLIENT") {
                messages += customerProjectDeal(
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerProjectDeal(
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "FINISH") {
            if (chat.userRole === "CLIENT") {
                messages += customerProjectFinish(
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerProjectFinish(
                    chat.project.id,
                    chat.project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "REVISI DIAJUKAN") {
            if (chat.userRole === "CLIENT") {
                messages += customerRevisionPurpose(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount,
                    chat.project.price,
                    dateFormat(new Date(chat.project.start_date)),
                    dateFormat(new Date(chat.project.end_date))
                );
            } else {
                messages += partnerRevisionPurpose(
                    perspectiveMessage,
                    chat.message[i].answer,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount,
                    chat.project.price,
                    dateFormat(new Date(chat.project.start_date)),
                    dateFormat(new Date(chat.project.end_date))
                );
            }
        } else if (chat.message[i].type === "REVISI DITOLAK") {
            if (chat.userRole === "CLIENT") {
                messages += revisionRejected(
                    chat.project.id,
                    chat.project.name,
                    chat.message[i].excuse
                );
            }
        }
    }

    return messages;
};

$(".navigation__item").on("click", (e) => {
    $(".navigation__item").removeClass("active");
    const nav = e.currentTarget;
    nav.classList.add("active");
    const chatId = nav.getAttribute("data-id");
    const chat = getChatProject(chatId);

    const chatContent = document.createElement("div");
    chatContent.classList.add("chatbox__messages__wrapper");
    chatContent.innerHTML = chat;
    const chatInput = `
        <form action="/admin/chat/${chatId}/add" method="POST">
            <input name="chat" placeholder="Masukkan pesan anda di sini" type="text" class="form-control">
            <button type="submit" class="btn btn-danger">Kirim</button>
        </form>
    `;
    const chatInputWrapper = $(".chatbox__input");
    console.log(chatInputWrapper);
    if (chatInputWrapper.length > 0) {
        chatInputWrapper.html(chatInput);
    }
    $(".chatbox__messages").html(chatContent);
});
