import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'
import collapse from '@alpinejs/collapse'
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Indonesian } from "flatpickr/dist/l10n/id.js";
flatpickr.localize(Indonesian);

Alpine.plugin(collapse)
Alpine.plugin(persist)
window.Alpine = Alpine
Alpine.start()

document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#datepicker", {
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr) {

             console.log('Selected Date:', dateStr);
    console.log('Trip Events:', window.tripEvents); 
            const events = window.tripEvents || [];

            let found = null;

            for (let trip of events) {
                const tripStart = trip.start.substring(0, 10); // buang waktu
                const tripEnd = trip.end.substring(0, 10);     // buang waktu

                if (dateStr >= tripStart && dateStr <= tripEnd) {
                    found = trip.name;
                    break;
                }
            }

            const tripInfo = document.getElementById("trip-info");
            if (!tripInfo) return;

            tripInfo.classList.remove("hidden");

            if (found) {
                tripInfo.innerHTML = `
                    <div class="flex items-start gap-3 text-forest">
                        <i class="fas fa-check-circle text-lg mt-0.5"></i>
                        <div>
                            <p class="font-semibold">Trip Tersedia</p>
                            <p class="text-sm text-forest/80">
                                Terdapat trip: <strong>${found}</strong> pada tanggal ini.
                            </p>
                        </div>
                    </div>
                `;
                tripInfo.className =
                    "mt-3 transition-all duration-300 rounded-xl border border-forest/30 bg-forest/10 p-4 text-sm font-medium text-forest shadow-sm";
            } else {
                tripInfo.innerHTML = `
                    <div class="flex items-start gap-3 text-gray-600">
                        <i class="fas fa-info-circle text-lg mt-0.5"></i>
                        <div>
                            <p class="font-semibold">Tidak Ada Trip</p>
                            <p class="text-sm text-gray-500">
                                Tidak ditemukan trip yang berlangsung pada tanggal ini.
                            </p>
                        </div>
                    </div>
                `;
                tripInfo.className =
                    "mt-3 transition-all duration-300 rounded-xl border border-stone-300 bg-stone-100 p-4 text-sm font-medium text-gray-700 shadow-sm";
            }
        }
    });
});

