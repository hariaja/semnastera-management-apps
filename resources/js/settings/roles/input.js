import { processPermission } from "@/utils.js";

$(() => {
    $('[name="all_permission"]').on("click", function () {
        if ($(this).is(":checked")) {
            $.each($(".permission"), function () {
                $(this).prop("checked", true);
            });
        } else {
            $.each($(".permission"), function () {
                $(this).prop("checked", false);
            });
        }
    });

    loadData(1);
});

let pages = 2;
let currentPage = 0;
let bool = false;
let lastPage;

$(window).scroll(function () {
    let height = $(document).height();
    if (
        $(window).scrollTop() + $(window).height() >= height &&
        bool == false &&
        lastPage > pages - 2
    ) {
        bool = true;
        $(".ajax-load").show();
        lazyLoad(pages).then(() => {
            bool = false;
            pages++;
            if (pages - 2 == lastPage) {
                $(".no-data").show();
            }
        });
    }
});

let roleHasPermission = [];

function lazyLoad(page) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "?page=" + page,
            type: "GET",
            beforeSend: function () {
                $(".ajax-load").show();
            },
            success: function (response) {
                $(".ajax-load").hide();

                if (response.roles && Array.isArray(response.roles)) {
                    roleHasPermission = response.roles;
                } else {
                    roleHasPermission = [];
                }

                let html = "";

                response.categories.data.forEach((item) => {
                    let permissionCategory = item.name;
                    let translatedName = processPermission(permissionCategory);

                    let permissionHtml = "";

                    item.permissions.forEach((permission) => {
                        let permissionName = permission.name;
                        let permissionTransName =
                            processPermission(permissionName);

                        let permissionInput = `
                            <input class="permission form-check-input" name="permission[${
                                permission.name
                            }]" id="permission-${
                            permission.name
                        }" type="checkbox" value="${permissionName}" ${
                            roleHasPermission.includes(permissionName)
                                ? "checked"
                                : ""
                        }>
                        `;

                        let permissionLabel = `
                            <label class="form-check-label" for="permission-${permission.name}">${permissionTransName}</label>
                        `;

                        permissionHtml += `
                            <div class="space-y-2">
                                <div class="form-check">
                                    ${permissionInput}
                                    ${permissionLabel}
                                </div>
                            </div>
                        `;
                    });

                    html += `
                        <div class="col-md-6 mb-3">
                            <div class="block block-rounded">
                                <div class="block-header block-header-default">
                                    <h3 class="block-title">
                                        ${translatedName}
                                    </h3>
                                </div>
                                <div class="block-content block-content-full">
                                    <div class="row">
                                        <div class="col">
                                            ${permissionHtml}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                $("#data-temp").append(html);
                resolve();
            },
        });
    });
}

function loadData(page) {
    $.ajax({
        url: "?page=" + page,
        type: "GET",
        beforeSend: function () {
            $(".ajax-load").show();
        },
        success: function (response) {
            $(".ajax-load").hide();
            lastPage = response.categories.last_page;

            if (response.roles && Array.isArray(response.roles)) {
                roleHasPermission = response.roles;
            } else {
                roleHasPermission = [];
            }

            let html = "";

            response.categories.data.forEach((item) => {
                let permissionCategory = item.name;
                let translatedName = processPermission(permissionCategory);

                let permissionHtml = "";

                item.permissions.forEach((permission) => {
                    let permissionName = permission.name;
                    let permissionTransName = processPermission(permissionName);

                    let permissionInput = `
                        <input class="permission form-check-input" name="permission[${
                            permission.name
                        }]" id="permission-${
                        permission.name
                    }" type="checkbox" value="${permissionName}" ${
                        roleHasPermission.includes(permissionName)
                            ? "checked"
                            : ""
                    }>
                    `;

                    let permissionLabel = `
                        <label class="form-check-label" for="permission-${permission.name}">${permissionTransName}</label>
                    `;

                    permissionHtml += `
                        <div class="space-y-2">
                            <div class="form-check">
                                ${permissionInput}
                                ${permissionLabel}
                            </div>
                        </div>
                    `;
                });

                html += `
                    <div class="col-md-6 mb-3">
                        <div class="block block-rounded">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">
                                    ${translatedName}
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div class="row">
                                    <div class="col">
                                        ${permissionHtml}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $("#data-temp").html(html);
        },
    });
}
