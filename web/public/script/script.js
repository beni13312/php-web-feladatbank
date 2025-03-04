// admin_dash
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
            ans_checkbox.classList.add("admindash-ans-res");
            ans_checkbox.name = `isResult-${this.ansid_num}`;

            ans_div.appendChild(ans_input);
            ans_div.appendChild(ans_checkbox);

            this.answers.push(ans_div);


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
