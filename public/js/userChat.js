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
            if (chat.userRole === "VENDOR") {
                messages += initiationPartnerChat(
                    perspectiveMessage,
                    chat.message[i].answer,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount
                );
            } else {
                messages += initiationCustomerChat(
                    perspectiveMessage,
                    chat.project.id,
                    chat.project.name,
                    chat.project.amount
                );
            }
        } else if (chat.message[i].type === "DIAJUKAN") {
            messages += proposeChat(
                perspectiveMessage,
                chat.project.id,
                chat.project.name,
                chat.project.amount,
                chat.project.price,
                dateFormat(new Date(chat.project.start_date)),
                dateFormat(new Date(chat.project.end_date))
            );
        } else if (chat.message[i].type === "VERIFIKASI") {
            messages += verificationChat(
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
                chat.project.price,
                dateFormat(new Date(chat.project.start_date)),
                dateFormat(new Date(chat.project.end_date))
            );
        } else if (chat.message[i].type === "SETUJU") {
            messages += negotiationAcceptChat(
                perspectiveMessage,
                chat.project.id,
                chat.project.name,
                chat.project.amount,
                chat.project.price,
                dateFormat(new Date(chat.project.start_date)),
                dateFormat(new Date(chat.project.end_date))
            );
        }
    }

    return messages;
};

$(".navigation__item").on("click", (e) => {
    $(".navigation__item").removeClass("active");
    const nav = e.currentTarget;
    nav.classList.add("active");

    const chat = getChatProject(nav.getAttribute("data-id"));

    const chatContent = document.createElement("div");
    chatContent.classList.add("chatbox__messages__wrapper");
    chatContent.innerHTML = chat;
    $(".chatbox__messages").html(chatContent);
});
