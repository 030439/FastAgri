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
			url: "fetch-suppliers", // Adjust the route based on your Laravel route
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
			{ title: "Name", data: "Name", visible: true },
			{ title: "Company", data: "company_name", visible: true },
			{ title: "Contact", data: "contact_no", visible: true },
			{ title: "CNIC", data: "nic", visible: true },
			{ title: "Address", data: "address", visible: true },
			{
				title: "button",
				data: "id",
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