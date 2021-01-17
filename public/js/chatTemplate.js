const initiationPartnerChat = (
    role,
    answer,
    projectId,
    projectName,
    projectAmount,
    customerId,
    partnerId,
    inboxId,
    chatId
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__projectDetail">
            <h6 class="chatbox__message__projectTitle">${projectName}</h6>
            <p class="chatbox__message__projectAmount">Jumlah: <strong>${projectAmount} buah</strong></p>
        </div>
        <div class="chatbox__message__description">
            <p>Ajukan penawaran sekarang!</p>
        </div>
        <div class="chatbox__message__choice">
            ${
                answer !== undefined && answer !== null && answer !== ""
                    ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "accept" ? "success" : "danger"
                    }">${answer === "accept" ? "Diajukan" : "Ditolak"}</span>`
                    : `
                    <button onclick="changeModalChatInitiationReject(this)" data-projectId="${projectId}" data-customerId="${customerId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-chatId="${chatId}" class="chatbox__message__initiationReject btn butline-danger" data-toggle="modal" data-target="#chatInitiationReject">Tolak</button>
                    <button onclick="changeModalChatNegotiation(this)" data-projectId="${projectId}" data-customerId="${customerId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-chatId="${chatId}" class="chatbox__message__initiationPropose btn btn-danger" data-toggle="modal" data-target="#chatNegotiation">Ajukan</button>
                    `
            }
        </div>
    </div>
    <br/>
    `;
};

const initiationCustomerChat = (
    role,
    projectId,
    projectName,
    projectAmount
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <div class="chatbox__message__description">
            <p>Kamu mengajukan Proyek ${projectAmount} buah ${projectName} (<a href="/user/project/${projectId}">#${projectId}</a>)</p>
        </div>
    </div>
    <br/>
    `;
};

const proposeChat = (
    role,
    projectId,
    projectName,
    projectAmount,
    projectPrice,
    projectStartDate,
    projectEndDate
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <div class="chatbox__message__description">
            <p>Kamu mengajukan Proyek ${projectAmount} buah ${projectName} (<a href="/user/project/${projectId}">#${projectId}</a>) dengan:</p>
            <p>Harga: <strong>Rp. ${projectPrice}</strong></p>
            <p>Mulai Pengerjaan: <strong>${projectStartDate}</strong></p>
            <p>Selesai Pengerjaan: <strong>${projectEndDate}</strong></p>
        </div>
    </div>
    `;
};

const verificationChat = (role, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p>Transaksi <a href="/user/customer/transaction/${transactionId}" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">#${transactionId}</a> telah diverifikasi.</p>
    </div>
    `;
};

const verificationRejectChat = (role, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p>Transaksi <a href="/user/customer/transaction/${transactionId}" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail">#${transactionId}</a> gagal diverifikasi. Silahkan ulangi </p>
    </div>
    `;
};

const negotiationChat = (
    role,
    answer,
    projectId,
    projectName,
    projectAmount,
    projectPrice,
    projectStartDate,
    projectEndDate,
    customerId,
    partnerId,
    inboxId,
    chatId,
    negotiationId
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__projectDetail">
            <p class="chatbox__message__projectPrice">Rp. ${projectPrice}</p>
            <h6 class="chatbox__message__projectTitle">${projectName}</h6>
            <p class="chatbox__message__projectAmount">Jumlah pesanan: <strong>${projectAmount} buah</strong></p>
            <p class="chatbox__message__projectDeadline">Mulai: <strong>${projectStartDate}</strong></p>
            <p class="chatbox__message__projectDeadline">Selesai: <strong>${projectEndDate}</strong></p>
        </div>
        <div class="chatbox__message__choice">
        ${
            answer !== undefined && answer !== null && answer !== ""
                ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "accept" ? "success" : "danger"
                    }">${answer === "accept" ? "Disetujui" : "Ditolak"}</span>`
                : `
                    <button onclick="changeModalChatNegotiation(this)" class="chatbox__message__negotiationReject btn btn-outline-danger" data-projectId="${projectId}" data-customerId="${customerId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#chatNegotiation">Nego</button>
                    <button onclick="changeModalChatNegotiationAccept(this)" class="chatbox__message__negotiationAccept btn btn-danger" data-projectId="${projectId}" data-customerId="${customerId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#chatAccept">Setuju</button>
                    `
        }
        </div>
    </div>
    `;
};

const negotiationAcceptChat = (
    role,
    projectId,
    projectName,
    projectAmount,
    projectPrice,
    projectStartDate,
    projectEndDate
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <div class="chatbox__message__description">
            <p>Proyek ${projectAmount} buah ${projectName} (<a href="/user/project/${projectId}">#${projectId}</a>) telah disetujui dengan:</p>
            <p>Harga: <strong>Rp. ${projectPrice}</strong></p>
            <p>Mulai Pengerjaan: <strong>${projectStartDate}</strong></p>
            <p>Selesai Pengerjaan: <strong>${projectEndDate}</strong></p>
        </div>
    </div>
    `;
};

const runProjectPermission = (
    answer,
    projectId,
    partnerId,
    inboxId,
    chatId,
    negotiationId
) => {
    return `
    <div class="chatbox__message chatbox__message--other">
        <div class="chatbox__message__description">
            <p>Apa yang ingin kamu lakukan ?</p>
        </div>
        <div class="chatbox__message__choice">
        ${
            answer !== undefined && answer !== null && answer !== ""
                ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "deal" ? "success" : "light"
                    }">${
                      answer  === "deal"
                          ? "Proyek dijalankan"
                          : "Permintaan sample diajukan"
                  }</span>`
                : `
                    <button onclick="changeModalChatAskSample(this)" class="chatbox__message__negotiationReject btn btn-outline-danger" data-projectId="${projectId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#askSample">Minta Sample</button>
                    <button onclick="changeModalChatProjectPermission(this)" class="chatbox__message__negotiationAccept btn btn-danger" data-projectId="${projectId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#runProject" data-projectId="${projectId}">Jalankan Proyek</button>
                    `
        }
        </div>
    </div>
    `;
};

const customerAskSample = (role, projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Kamu telah mengajukan permintaan sample kepada vendor untuk proyek ${projectName}. Klik "Lihat Transaksi" untuk melihat detail transaksi.</p>
        </div>
        <div class="chatbox__message__choice">
            <a href="/home/transaction"><button class="chatbox__message__negotiationAccept btn btn-outline-danger">Lihat Transaksi</button></a>
        </div>
    </div>
    `;
};

const partnerAskSample = (role, projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Pelanggan telah mengajukan permintaan sample kepada vendor untuk proyek ${projectName}.</p>
        </div>
    </div>
    `;
};

const customerSampleDelivered = (
    role,
    answer,
    projectId,
    partnerId,
    inboxId,
    negotiationId,
    chatId
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <div class="chatbox__message__description">
            <p>Sample sudah dikirim! Klik <a href="/user/project/${projectId}">di sini</a> untuk melihat sample! Bagaimana pendapatmu?</p>
        </div>
        <div class="chatbox__message__choice">
        ${
            answer !== undefined && answer !== null && answer !== ""
                ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "deal" ? "success" : "light"
                    }">${
                      answer === "deal"
                          ? "Proyek dijalankan"
                          : "Permintaan sample diajukan"
                  }</span>`
                : `
                <button onclick="changeModalChatAskSample(this)" class="chatbox__message__negotiationReject btn btn-outline-danger" data-projectId="${projectId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#askSample">Minta Sample Kembali</button>
                <button onclick="changeModalChatProjectPermission(this)" class="chatbox__message__negotiationAccept btn btn-danger" data-projectId="${projectId}" data-partnerId="${partnerId}" data-inboxId="${inboxId}" data-negotiationId="${negotiationId}" data-chatId="${chatId}" data-toggle="modal" data-target="#runProject" data-projectId="${projectId}">Jalankan Proyek</button>
                    `
        }
        </div>
    </div>
    `;
};

const partnerSampleDelivered = (role, projectId, projectName) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Kamu telah mengirimkan sample untuk proyek ${projectName}.</p>
        </div>
    </div>
    `;
};

const customerProjectDeal = (projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--me">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Kamu telah menyetujui proyek ${projectName}. Proyek sedang dikerjakan oleh vendor. Klik "Lihat Transaksi" untuk melihat detail transaksi pembayaran DP.</p>
        </div>
        <div class="chatbox__message__choice">
            <a href="/user/transaction/${transactionId}"><button class="chatbox__message__negotiationAccept btn btn-outline-danger">Lihat Transaksi</button></a>
        </div>
    </div>
    `;
};

const partnerProjectDeal = (projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--other">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Pelanggan telah menyetujui proyek ${projectName}. Silahkan mulai untuk mengerjakan proyek dari sekarang !</p>
        </div>
    </div>
    `;
};

const customerProjectFinish = (projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--other">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Proyek ${projectName} telah selesai dikerjakan oleh vendor. Klik "Lihat Transaksi" untuk melihat detail transaksi pembayaran pelunasan.</p>
        </div>
        <div class="chatbox__message__choice">
            <a href="/user/transaction/${transactionId}"><button class="chatbox__message__negotiationAccept btn btn-outline-danger">Lihat Transaksi</button></a>
        </div>
    </div>
    `;
};

const partnerProjectFinish = (projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--other">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Proyek ${projectName} telah selesai dikerjakan.</p>
        </div>
    </div>
    `;
};

const customerRevisionPurpose = (
    role,
    projectId,
    projectName,
    projectAmount,
    projectPrice,
    projectStartDate,
    projectEndDate
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__projectDetail">
            <p class="chatbox__message__projectPrice">Rp. ${projectPrice}</p>
            <h6 class="chatbox__message__projectTitle">${projectName}</h6>
            <p class="chatbox__message__projectAmount">Jumlah pesanan: <strong>${projectAmount} buah</strong></p>
            <p class="chatbox__message__projectDeadline">Mulai: <strong>${projectStartDate}</strong></p>
            <p class="chatbox__message__projectDeadline">Selesai: <strong>${projectEndDate}</strong></p>
        </div>
    </div>
    `;
};

const partnerRevisionPurpose = (
    role,
    answer,
    projectId,
    projectName,
    projectAmount,
    projectPrice,
    projectStartDate,
    projectEndDate
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__projectDetail">
            <p class="chatbox__message__projectPrice">Rp. ${projectPrice}</p>
            <h6 class="chatbox__message__projectTitle">Revisi Proyek ${projectName}</h6>
            <p class="chatbox__message__projectAmount">Jumlah pesanan: <strong>${projectAmount} buah</strong></p>
            <p class="chatbox__message__projectDeadline">Mulai: <strong>${projectStartDate}</strong></p>
            <p class="chatbox__message__projectDeadline">Selesai: <strong>${projectEndDate}</strong></p>
        </div>
        <div class="chatbox__message__choice">
        ${
            answer !== undefined && answer !== null && answer !== ""
                ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "accept" ? "success" : "danger"
                    }">${answer === "accept" ? "Disetujui" : "Ditolak"}</span>`
                : `
                    <button class="chatbox__message__negotiationReject btn btn-outline-danger" data-toggle="modal" data-target="#revisionReject">Nego</button>
            <button class="chatbox__message__negotiationAccept btn btn-danger" data-toggle="modal" data-target="#revisionAccept">Setuju</button>
                    `
        }
        </div>
    </div>
    `;
};

const revisionRejected = (projectId, projectName, excuse) => {
    return `
    <div class="chatbox__message chatbox__message--other">
        <div class="chatbox__message__description">
            <p>Revisi terhadap proyek ${projectName} (#${projectId}) <strong>ditolak</strong> dengan alasan <strong>${excuse}</strong></p>
        </div>
    </div>
    `;
};

const reviewProject = (projectId, projectName, role) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Project ${projectName} telah dikirim! Ulas proyek ini untuk mengetahui pendapat anda tentang pelayanan kami.</p>
        </div>
        <form class="auth-form" method="POST" action="/chat/review/${projectId}">
            <div class="body">
                <div class="review" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="star" value="1" id="star1" autocomplete="off">
                    <label class="review__star" for="star1">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </label>

                    <input type="radio" class="btn-check" name="star" value="2" id="star2" autocomplete="off">
                    <label class="review__star" for="star2">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </label>

                    <input type="radio" class="btn-check" name="star" value="3" id="star3" autocomplete="off">
                    <label class="review__star" for="star3">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </label>

                    <input type="radio" class="btn-check" name="star" value="4" id="star4" autocomplete="off">
                    <label class="review__star" for="star4">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </label>

                    <input type="radio" class="btn-check" name="star" value="5" id="star5" autocomplete="off">
                    <label class="review__star" for="star5">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M0 0h24v24H0z" fill="none"/><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    </label>
                </div>
            </div>
            <div class="chatbox__message__choice">
                <button type="submit" class="btn btn-danger">Ulas Sekarang!</button>
            </div>
        </form>
    </div>
    `;
};
