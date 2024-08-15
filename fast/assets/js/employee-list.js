const ready = (fn) => {
    if (document.readyState !== "loading") {
        fn();
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
};
let table;
ready(() => {
    table = new DataTable("#index", {
        language: {},
        serverSide: true, // Enable server-side processing
        ajax: {
            url: "employees-listing", // Adjust the route based on your Laravel route
            dataSrc: "data",
            data: function (params) {
                params.vendor = $("#selectVendor").val();
                params.startDate = $("#startDate").val();
                params.endDate = $("#endDate").val();
                params.page = params.start / params.length + 1; // Calculate current page
                params.limit = params.length; // Number of records per page
                return params;
            },
        },
        columns: [
            { title: "Name", data: "Name", visible: true },
            { title: "Designation", data: "designation", visible: true },
            { title: "Category", data: "category", visible: true },
            { title: "Address", data: "Address", visible: true },
            { title: "Phone", data: "ContactNo", visible: true },
            { title: "Basic Salary", data: "BasicSalary", visible: true },
            {
                title: "Status",
                data: null,
                render: function (data, type, row) {
                    return '<span class="status-tag text-xs font-semibold leading-5 text-white px-2.5 h-5 rounded-[3px] bg-green-500">Completed</span>';
                },
            },
            {
                title: "Action",
                data: "id",
                render: function (data, type, row) {
                    return `<div class="dropdown">
                                <button class="common-action-menu-style">Action <i class="fa-sharp fa-solid fa-caret-down"></i></button>
                                <div class="dropdown-list">
                                    <button class="dropdown-menu-item"><img src="assets/img/icon/action-2.png" alt="icon not found"><span>Update</span></button>
                                    <button class="dropdown-menu-item"><img src="assets/img/icon/action-6.png" alt="icon not found"><span>Delete</span></button>
                                </div>
                            </div>`;
                },
            },
        ],
        paging: true,
        autoWidth: true,
        scrollX: true,
        lengthMenu: [10, 25, 50, 100],
        buttons: ["pageLength"],
        destroy: true,
        deferRender: true,
        responsive: false,
        createdRow: function (row, data, dataIndex) {
            // Apply Tailwind CSS classes to the created rows
            row.classList.add("flex", "border-b", "border-solid", "border-grayBorder", "h-12");
        },
    });
    window.applyDateFilters = function () {
        table.ajax.reload();
    };
});
