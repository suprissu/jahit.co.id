const initiationChat = (
    role,
    answer,
    projectId,
    projectName,
    projectAmount
) => {
    return `
    <div class="chatbox__message chatbox__message--${role}">
        <p class="chatbox__message__projectLabel">Proyek <a href="/user/customer/project/${projectId}">#${projectId}</a></p>
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
                    <button class="chatbox__message__initiationReject btn butline-danger" data-toggle="modal" data-target="#chatVendorReject">Tolak</button>
                    <button class="chatbox__message__initiationPropose btn btn-danger" data-toggle="modal" data-target="#chatVendorNegotiation">Ajukan</button>
                    `
            }
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
