<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* =====================================================
         * MODAL TÓM TẮT
         * ===================================================== */
        const summaryBtn = document.querySelector(".open-summary-modal");
        const summaryEditor = document.getElementById("SummaryEditor");
        const tomTatHidden = document.getElementById("TomTatHidden");
        const saveSummaryBtn = document.getElementById("saveSummaryBtn");
        const shortSummaryDiv = document.getElementById("shortSummary");

        if (summaryBtn && summaryEditor && tomTatHidden) {
            summaryBtn.addEventListener("click", () => {
                summaryEditor.value = tomTatHidden.value || "";
            });
        }

        if (saveSummaryBtn) {
            saveSummaryBtn.addEventListener("click", () => {
                const value = summaryEditor.value || "";

                tomTatHidden.value = value;
                shortSummaryDiv.innerText =
                    value ?
                    (value.length > 70 ? value.substring(0, 70) + "..." : value) :
                    "(Chưa có tóm tắt)";

                bootstrap.Modal.getInstance(
                    document.getElementById("summaryModal")
                ).hide();
            });
        }

        /* =====================================================
         * TÁC GIẢ
         * ===================================================== */
        const saveAuthorsBtn = document.getElementById("saveAuthorsBtn");
        const currentAuthorsDiv = document.getElementById("currentAuthors");
        const hiddenAuthorsBox = document.getElementById("hidden-authors");

        function renderAuthorsFromHidden() {
            if (!hiddenAuthorsBox || !currentAuthorsDiv) return;

            const inputs = hiddenAuthorsBox.querySelectorAll("input[name='tacGias[]']");
            const names = [];

            inputs.forEach(input => {
                const label = document.querySelector(
                    `#authorsModal input[value="${input.value}"]`
                )?.nextElementSibling;

                if (label) names.push(label.textContent.trim());
            });

            currentAuthorsDiv.textContent =
                names.length ? names.join(", ") : "(Chưa chọn tác giả)";
        }

        if (saveAuthorsBtn) {
            saveAuthorsBtn.addEventListener("click", () => {

                const checked = document.querySelectorAll(
                    "#authorsModal input[type='checkbox']:checked"
                );

                hiddenAuthorsBox.innerHTML = "";
                const names = [];

                checked.forEach(cb => {
                    names.push(cb.nextElementSibling.textContent.trim());

                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "tacGias[]";
                    input.value = cb.value;
                    hiddenAuthorsBox.appendChild(input);
                });

                currentAuthorsDiv.textContent =
                    names.length ? names.join(", ") : "(Chưa chọn tác giả)";

                bootstrap.Modal.getInstance(
                    document.getElementById("authorsModal")
                ).hide();
            });
        }

        renderAuthorsFromHidden();

        /* =====================================================
         * THỂ LOẠI
         * ===================================================== */
        const saveCategoriesBtn = document.getElementById("saveCategoriesBtn");
        const currentCategoriesDiv = document.getElementById("currentCategories");
        const hiddenCategoriesBox = document.getElementById("hidden-categories");

        function renderCategoriesFromHidden() {
            if (!hiddenCategoriesBox || !currentCategoriesDiv) return;

            const inputs = hiddenCategoriesBox.querySelectorAll("input[name='theLoais[]']");
            const names = [];

            inputs.forEach(input => {
                const label = document.querySelector(
                    `#categoriesModal input[value="${input.value}"]`
                )?.nextElementSibling;

                if (label) names.push(label.textContent.trim());
            });

            currentCategoriesDiv.textContent =
                names.length ? names.join(", ") : "(Chưa chọn thể loại)";
        }

        if (saveCategoriesBtn) {
            saveCategoriesBtn.addEventListener("click", () => {

                const checked = document.querySelectorAll(
                    "#categoriesModal input[type='checkbox']:checked"
                );

                hiddenCategoriesBox.innerHTML = "";
                const names = [];

                checked.forEach(cb => {
                    names.push(cb.nextElementSibling.textContent.trim());

                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "theLoais[]";
                    input.value = cb.value;
                    hiddenCategoriesBox.appendChild(input);
                });

                currentCategoriesDiv.textContent =
                    names.length ? names.join(", ") : "(Chưa chọn thể loại)";

                bootstrap.Modal.getInstance(
                    document.getElementById("categoriesModal")
                ).hide();
            });
        }

        renderCategoriesFromHidden();

        /* =====================================================
         * SỐ LƯỢNG & TRẠNG THÁI
         * ===================================================== */
        const qtyRadios = document.querySelectorAll("input[name='SoLuong']");
        const statusCon = document.getElementById("statusCon");
        const statusHet = document.getElementById("statusHet");
        const statusThuThu = document.getElementById("statusThuThu");

        function updateStatusByQty(qty) {
            if (!statusCon || !statusHet || !statusThuThu) return;

            if (qty === "0") {
                statusHet.checked = true;
                statusHet.disabled = false;

                statusCon.disabled = true;
                statusThuThu.disabled = true;
            } else {
                if (statusHet.checked) statusCon.checked = true;

                statusHet.disabled = true;
                statusCon.disabled = false;
                statusThuThu.disabled = false;
            }
        }

        qtyRadios.forEach(radio => {
            radio.addEventListener("change", function() {
                updateStatusByQty(this.value);
            });
        });

        const checkedQty = document.querySelector("input[name='SoLuong']:checked");
        if (checkedQty) {
            updateStatusByQty(checkedQty.value);
        }

    });
</script>