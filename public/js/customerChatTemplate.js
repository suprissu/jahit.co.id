const initiationChat = (role, projectId, projectName, projectAmount) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <div class="chatbox__message__description">
            <p>Kamu mengajukan Proyek ${projectAmount} buah ${projectName} (<a href="/user/customer/project/${projectId}">#${projectId}</a>)</p>
        </div>
    </div>
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
            <p>Kamu mengajukan Proyek ${projectAmount} buah ${projectName} (<a href="/user/customer/project/${projectId}">#${projectId}</a>) dengan:</p>
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
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/customer/project/${projectId}">#${projectId}</a></p>
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
                    <button class="chatbox__message__negotiationReject btn btn-outline-danger" data-toggle="modal" data-target="#chatVendorNegotiation">Nego</button>
            <button class="chatbox__message__negotiationAccept btn btn-danger" data-toggle="modal" data-target="#chatVendorAccept">Setuju</button>
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
            <p>Proyek ${projectAmount} buah ${projectName} (<a href="/user/customer/project/${projectId}">#${projectId}</a>) telah disetujui dengan:</p>
            <p>Harga: <strong>Rp. ${projectPrice}</strong></p>
            <p>Mulai Pengerjaan: <strong>${projectStartDate}</strong></p>
            <p>Selesai Pengerjaan: <strong>${projectEndDate}</strong></p>
        </div>
    </div>
    `;
};
