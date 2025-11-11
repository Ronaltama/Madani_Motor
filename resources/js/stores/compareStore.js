import { defineStore } from "pinia";

export const useCompareStore = defineStore("compare", {
    state: () => ({
        selectedCars: [],
    }),

    actions: {
        toggleCompare(car) {
            const exists = this.selectedCars.find((c) => c.id === car.id);
            if (exists) {
                this.selectedCars = this.selectedCars.filter(
                    (c) => c.id !== car.id
                );
            } else if (this.selectedCars.length < 3) {
                this.selectedCars.push(car);
            } else {
                alert("Maksimal 3 mobil bisa dibandingkan!");
            }
        },

        clearCompare() {
            this.selectedCars = [];
        },
    },
});
