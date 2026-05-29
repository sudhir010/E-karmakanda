document.addEventListener("DOMContentLoaded", () => {
  const prevBtn = document.getElementById("prev-month");
  const nextBtn = document.getElementById("next-month");
  const currentLabel = document.getElementById("current-month-year");
  const grid = document.getElementById("calendar-grid");

  function getBsDate(adDate) {
    return NepaliDateConverter.ad2bs(adDate).bsDate;
  }

  const todayAd = new Date();
  const { bs } = NepaliDateConverter.ad2bs(todayAd);
  let bsYear = bs[0],
    bsMonth = bs[1],
    bsDay = bs[2];

  function render() {
    grid.innerHTML = "";
    currentLabel.textContent = `BS ${bsYear} – ${bsMonth}`;

    const monthDays = NepaliDateConverter.getBsMonthDays(bsYear, bsMonth);
    for (let d = 1; d <= monthDays; d++) {
      const cell = document.createElement("div");
      cell.className = "calendar-cell";
      cell.textContent = d;

      if (d === bsDay && bsYear === bs[0] && bsMonth === bs[1]) {
        cell.classList.add("today");
      }

      const key = `${bsYear}-${String(bsMonth).padStart(2, "0")}-${String(
        d
      ).padStart(2, "0")}`;
      const events = {
        [`${bsYear}-${String(bsMonth).padStart(2, "0")}-15`]: "Purnima",
        [`${bsYear}-${String(bsMonth).padStart(2, "0")}-07`]: "Ekadashi",
      };
      if (events[key]) {
        const sp = document.createElement("span");
        sp.className = "event";
        sp.textContent = events[key];
        cell.appendChild(sp);
      }

      grid.appendChild(cell);
    }
  }

  prevBtn.onclick = () => {
    bsMonth--;
    if (bsMonth < 1) {
      bsMonth = 12;
      bsYear--;
    }
    render();
  };
  nextBtn.onclick = () => {
    bsMonth++;
    if (bsMonth > 12) {
      bsMonth = 1;
      bsYear++;
    }
    render();
  };

  render();
});
