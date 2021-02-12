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

    let project;
    let projectId;
    let customerId;
    let inboxId;

    for (let i = chat.message.length - 1; i >= 0; i--) {
        if (chat.message[i].role === chat.userRole) {
            perspectiveMessage = "me";
        } else if (chat.message[i].role === "ADMIN") {
            perspectiveMessage = "admin";
        } else {
            perspectiveMessage = "other";
        }

        if (chat.id === "_OFFER_") {
            project = chat.message[i].project;
            projectId = chat.message[i].project.id;
            customerId = chat.message[i].customerId;
            inboxId = chat.message[i].inboxId;
        } else {
            project = chat.project;
            projectId = chat.project.id;
            customerId = chat.customerId;
            inboxId = chat.id;
        }

        if (chat.message[i].type === "INISIASI") {
            if (chat.userRole === "CLIENT") {
                if (chat.message[i].answer === "reject") {
                    messages += initiationPartnerChat(
                        perspectiveMessage,
                        chat.message[i].answer,
                        project.id,
                        project.name,
                        project.amount,
                        customerId,
                        chat.partnerId,
                        inboxId,
                        chat.message[i].id
                    );
                }
                messages += initiationCustomerChat(
                    perspectiveMessage,
                    project.id,
                    project.name,
                    project.amount
                );
            } else {
                messages += initiationPartnerChat(
                    perspectiveMessage,
                    chat.message[i].answer,
                    project.id,
                    project.name,
                    project.amount,
                    customerId,
                    chat.partnerId,
                    inboxId,
                    chat.message[i].id
                );
            }
        } else if (chat.message[i].type === "DIAJUKAN") {
            messages += proposeChat(
                perspectiveMessage,
                project.id,
                project.name,
                project.amount,
                priceFormat(chat.message[i].negotiation.price),
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
                project.id,
                project.name,
                project.amount,
                priceFormat(chat.message[i].negotiation.price),
                dateFormat(new Date(chat.message[i].negotiation.start_date)),
                dateFormat(new Date(chat.message[i].negotiation.end_date)),
                customerId,
                chat.partnerId,
                inboxId,
                chat.message[i].id,
                chat.message[i].negotiation.id
            );
        } else if (chat.message[i].type === "SETUJU") {
            if (chat.userRole === "CLIENT") {
                messages += runProjectPermission(
                    chat.message[i].answer,
                    project.id,
                    chat.partnerId,
                    inboxId,
                    chat.message[i].id,
                    chat.message[i].negotiation.id
                );
            }
            messages += negotiationAcceptChat(
                perspectiveMessage,
                project.id,
                project.name,
                project.amount,
                priceFormat(chat.message[i].negotiation.price),
                dateFormat(new Date(chat.message[i].negotiation.start_date)),
                dateFormat(new Date(chat.message[i].negotiation.end_date))
            );
        } else if (chat.message[i].type === "SAMPLE") {
            if (chat.userRole === "CLIENT") {
                messages += customerAskSample(
                    perspectiveMessage,
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerAskSample(
                    perspectiveMessage,
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "SAMPLE TERKIRIM") {
            if (chat.userRole === "CLIENT") {
                messages += customerSampleDelivered(
                    perspectiveMessage,
                    chat.message[i].answer,
                    project.id,
                    chat.partnerId,
                    inboxId,
                    chat.message[i].negotiation.id,
                    chat.message[i].id
                );
            } else {
                messages += partnerSampleDelivered(
                    perspectiveMessage,
                    project.id,
                    project.name
                );
            }
        } else if (chat.message[i].type === "DEAL") {
            if (chat.userRole === "CLIENT") {
                messages += customerProjectDeal(
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerProjectDeal(
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "FINISH") {
            if (chat.userRole === "CLIENT") {
                messages += customerProjectFinish(
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            } else {
                messages += partnerProjectFinish(
                    project.id,
                    project.name,
                    chat.transaction.id
                );
            }
        } else if (chat.message[i].type === "REVISI DIAJUKAN") {
            if (chat.userRole === "CLIENT") {
                messages += customerRevisionPurpose(
                    perspectiveMessage,
                    project.id,
                    project.name,
                    project.amount,
                    priceFormat(project.price),
                    dateFormat(new Date(project.start_date)),
                    dateFormat(new Date(project.end_date))
                );
            } else {
                messages += partnerRevisionPurpose(
                    perspectiveMessage,
                    chat.message[i].answer,
                    project.id,
                    project.name,
                    project.amount,
                    priceFormat(project.price),
                    dateFormat(new Date(project.start_date)),
                    dateFormat(new Date(project.end_date))
                );
            }
        } else if (chat.message[i].type === "REVISI DITOLAK") {
            if (chat.userRole === "CLIENT") {
                messages += revisionRejected(
                    project.id,
                    project.name,
                    chat.message[i].excuse
                );
            }
        } else if (chat.message[i].type === "REVIEW") {
            if (chat.userRole === "CLIENT") {
                messages += reviewProject(
                    project.id,
                    chat.project.name,
                    perspectiveMessage,
                    inboxId,
                    chat.message[i].id,
                    chat.csrf,
                    chat.message[i].answer
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
    $(".userChat .chatbox__messages").html(chatContent);
});
