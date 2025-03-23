class manage_ans {
    constructor(div_id) {
        this.div_id = div_id;
        this.ansid_num = 3; // 2 alap html oldalon
        this.answers = []; // hozzádott
    }

    add_ans() {
        if (this.ansid_num === 10) { // max 10
            document.getElementById("admindash-ans-add").disabled = true;
        }

        const element_div = document.getElementById(this.div_id);
        if (element_div) {

            // div
            let ans_div = document.createElement("div");
            ans_div.classList.add("admindash-ans");

            // input-text
            let ans_input = document.createElement("input");
            ans_input.type = "text";
            ans_input.id = `ans-${this.ansid_num}`;
            ans_input.name = `ans-${this.ansid_num}`;
            ans_input.placeholder = `Válasz${this.ansid_num}`;

            // input-checkbox
            let ans_checkbox = document.createElement("input");
            ans_checkbox.type = "checkbox";
            ans_checkbox.classList.add("admindash-ans-sol");
            ans_checkbox.name = `isSol-${this.ansid_num}`;
            ans_checkbox.id = `isSol-${this.ansid_num}`;

            // checkbox-label
            let checkbox_label = document.createElement("label");
            checkbox_label.setAttribute("for",`isSol-${this.ansid_num}`);
            checkbox_label.textContent = "Megoldás";

            // append to div
            ans_div.appendChild(ans_input);
            ans_div.appendChild(ans_checkbox);
            ans_div.appendChild(checkbox_label);

            this.answers.push(ans_div);

            // append to div container
            element_div.appendChild(ans_div);

            this.ansid_num++;
        }
    }

    remove_ans() {
        if (this.answers.length > 0) {
            const last_answer = this.answers.pop();
            last_answer.parentNode.removeChild(last_answer);
            this.ansid_num--;

            if (this.ansid_num < 11) {
                document.getElementById("admindash-ans-add").disabled = false;

            }
        }
    }
}

addEventListener("DOMContentLoaded", () => {
    const manage = new manage_ans("admindash-ans-n");

    document.getElementById("admindash-ans-add").addEventListener("click", () => {
        manage.add_ans();
    });

    document.getElementById("admindash-ans-rm").addEventListener("click", () => {
        manage.remove_ans();
    });
});
