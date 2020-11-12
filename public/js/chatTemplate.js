const initiationPartnerChat = (
    role,
    answer,
    projectId,
    projectName,
    projectAmount
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__projectDetail">
            <h6 class="chatbox__message__projectTitle">${projectName}</h6>
            <p class="chatbox__message__projectAmount">Jumlah: <strong>${projectAmount} buah</strong></p>
        </div>
        <div class="chatbox__message__description">
            <p>Ahmad telah menambah proyek. Ajukan penawaran sekarang!</p>
        </div>
        <div class="chatbox__message__choice">
            ${
                answer !== undefined || answer !== null || answer !== ""
                    ? `
                    <span class="py-2 px-3 badge badge-${
                        answer === "accept" ? "success" : "danger"
                    }">${answer === "accept" ? "Diajukan" : "Ditolak"}</span>`
                    : `
                    <button class="chatbox__message__initiationReject btn butline-danger" data-toggle="modal" data-target="#chatReject">Tolak</button>
                    <button class="chatbox__message__initiationPropose btn btn-danger" data-toggle="modal" data-target="#chatNegotiation">Ajukan</button>
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

const negotiationChat = (
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
                    <button class="chatbox__message__negotiationReject btn btn-outline-danger" data-toggle="modal" data-target="#chatNegotiation">Nego</button>
            <button class="chatbox__message__negotiationAccept btn btn-danger" data-toggle="modal" data-target="#chatAccept">Setuju</button>
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

const runProjectPermission = (answer) => {
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
                      answer === "deal"
                          ? "Proyek dijalankan"
                          : "Permintaan sample diajukan"
                  }</span>`
                : `
                    <button class="chatbox__message__negotiationReject btn btn-outline-danger" data-toggle="modal" data-target="#askSample">Minta Sample</button>
            <button class="chatbox__message__negotiationAccept btn btn-danger" data-toggle="modal" data-target="#runProject">Jalankan Proyek</button>
                    `
        }
        </div>
    </div>
    `;
};

const askSample = (role, projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/project/${projectId}">#${projectId}</a></p>
        <div class="chatbox__message__description">
            <p>Kamu telah mengajukan permintaan sample kepada vendor untuk proyek ${projectName}. Klik "Lihat Transaksi" untuk melihat detail transaksi.</p>
        </div>
        <div class="chatbox__message__choice">
            <a href="/user/transaction/${transactionId}"><button class="chatbox__message__negotiationAccept btn btn-outline-danger">Lihat Transaksi</button></a>
        </div>
    </div>
    `;
};

const sampleDelivered = (answer, projectId) => {
    return `
    <div class="chatbox__message chatbox__message--other">
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
                    <button class="chatbox__message__negotiationReject btn btn-outline-danger" data-toggle="modal" data-target="#askSample">Minta Sample Kembali</button>
            <button class="chatbox__message__negotiationAccept btn btn-danger" data-toggle="modal" data-target="#runProject">Jalankan Proyek</button>
                    `
        }
        </div>
    </div>
    `;
};

const projectDeal = (role, projectId, projectName, transactionId) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
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
