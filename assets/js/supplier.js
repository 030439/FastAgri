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
			url: "filtered", // Adjust the route based on your Laravel route
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
		paging: true,
		autoWidth: true,
		scrollX: true,

		lengthMenu: [10, 25, 50, 100],
		buttons: ["pageLength"],
		destroy: true,
		deferRender: true,

		// responsive: {
		//   details: {
		//     display: $.fn.dataTable.Responsive.display.modal({
		//       header: (row) => {
		//         let data = row.data();
		//         return data[0];
		//       },
		//     }),
		//     renderer: (api, rowIdx, columns) => {
		//       let data = $.map(columns, (col, i) => {
		//         return col.hidden
		//           ? col.data
		//             ? `
		//                                       <tr class="d-flex flex-column mb-3"
		//                                         data-dt-row="${col.rowIndex}"
		//                                         data-dt-column="${col.columnIndex}">
		//                                         <td class="d-flex w-100">
		//                                           <strong>${col.title}:</strong>
		//                                         </td>
		//                                         <td class="d-flex w-100">
		//                                           ${col.data}
		//                                         </td>
		//                                       </tr>
		//                                       `
		//             : ""
		//           : "";
		//       }).join("");

		//       return data ? $('<table class="w-100"/>').append(data) : false;
		//     },
		//   },
		// },
		responsive: false,

		/* end responsive */

		/* columnDefs */
		columns: [
			{ title: "Ticket_Id", data: "Ticket_Id", visible: true },
			{ title: "Time", data: "Time", visible: true },
			{ title: "Action", data: "Action", visible: true },
			{ title: "Type", data: "Type", visible: true },
			{ title: "Type_Detail", data: "Type_Detail", visible: true },
			{ title: "Account", data: "Account", visible: true },
			{ title: "Parent", data: "Parent", visible: true },
			{ title: "Amount", data: "Amount", visible: true },
			{ title: "Script", data: "Script", visible: true },
			{ title: "Price", data: "Price", visible: true },
			{ title: "Close_Price", data: "Close_Price", visible: true },
			{ title: "Total_PnL", data: "Total_PnL", visible: true },
			{ title: "SL", data: "SL", visible: true },
			{ title: "TP", data: "TP", visible: true },
			{ title: "Open_Position", data: "Open_Position", visible: true },
			{ title: "Open_Date", data: "Open_Date", visible: true },
			{ title: "Time_Diff", data: "Time_Diff", visible: true },
			{ title: "Created_By", data: "Created_By", visible: true },
			{ title: "Comment", data: "Comment", visible: true },
			{ title: "IP", data: "IP", visible: true },
			{
				title: "Script_Description",
				data: "Script_Description",
				visible: true,
			},
			{ title: "Expiry_Date", data: "Expiry_Date", visible: true },
			{ title: "Method", data: "Method", visible: true },
			{ title: "Contract_Size", data: "Contract_Size", visible: true },
			{
				title: "button",
				data: "Account",
				visible: true,
				render: function (data, type, row) {
					// Assuming you want to create a button with a specific class
					return (
						"<button onClick='showProfile(" +
						data +
						");' class='databutton'>Detail</button>"
					);
				},
			},
		],

		/* end columnDefs */
	});
	window.applyDateFilters = function () {
		table.ajax.reload();
	};
});

function fetchAllRecords() {
	table.ajax.reload();
}
function showProfile(id) {
	window.location.href = "/profile/" + id;
}