<?php

namespace App\Fixture;

use App\Entity\Item;
use App\Entity\ItemSerie;
use App\Entity\Serie;
use App\Entity\SerieImportator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BadCaseFixture extends Fixture
{
	public function load(ObjectManager $manager)
	{
		for($iSerie = 1; $iSerie <= 2; $iSerie++)
		{
			$serie = new Serie();
			$serie->setLibelle('Serie ' . $iSerie);
			$manager->persist($serie);

			$serieImportator = new SerieImportator();
			$serieImportator->setLibelle('imp ' . $iSerie);
			$serieImportator->setSerie($serie);
			$manager->persist($serieImportator);

			for($iItem = 1; $iItem <= 12; $iItem++)
			{
				$item = new Item();
				$item->setLibelle('Item ' . $iSerie . '.' . $iItem);

				$itemSerie = new ItemSerie();
				$itemSerie->setSerie($serie);
				$itemSerie->setItem($item);
				$itemSerie->setNumber('Num '.  $iSerie . '.' . $iItem);


				$manager->persist($item);
				$manager->persist($itemSerie);
			}
		}

		$manager->flush();
	}
}