<?php

namespace Rennokki\Larafy\Traits;

trait ArtistsTrait
{
    /**
     * Get artists based on IDs.
     *
     * @param string|array $artistsIds
     * @return string The JSON response.
     */
    public function getArtists(array $artistIds)
    {
        $artistIds = implode(',', $artistIds);
        $json = $this->get('artists', [
            'ids' => $artistIds,
        ]);

        return $json->artists;
    }


    /**
     * Get an artist based on ID.
     *
     * @param string $artistId
     * @return string The JSON response.
     */
    public function getArtist(string $artistId)
    {
        $json = $this->get('artists/' . $artistId);

        return $json;
    }


    /**
     * Get an artist's albums.
     *
     * @param string $artistId
     * @param int $limit
     * @param int $offset
     * @param string|array $includeGroups
     * @return string The JSON response.
     */
    public function getArtistAlbums(string $artistId, int $limit = 10, int $offset = 0, $includeGroups = ['single', 'appears_on'])
    {
        if (is_array($includeGroups)) {
            $includeGroups = collect($includeGroups)->implode(',');
        }

        return $this->get('artists/' . $artistId . '/albums', [
            'include_groups' => $includeGroups,
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }


    /**
     * Get an artist's top tracks.
     *
     * @param string $artistId
     * @return string The JSON response.
     */
    public function getArtistTopTracks(string $artistId)
    {
        return $this->get('artists/' . $artistId . '/top-tracks', [
            'country' => $this->market,
        ]);
    }


    /**
     * Get related artists from an artist.
     *
     * @param string $artistId
     * @return string The JSON response.
     */
    public function getArtistRelatedArtists(string $artistId)
    {
        return $this->get('artists/' . $artistId . '/related-artists');
    }


    /**
     * Search artists based on a query.
     *
     * @param string $query
     * @param int $limit
     * @param int $offset
     * @return string The JSON response.
     */
    public function searchArtists(string $query, int $limit = 10, int $offset = 0)
    {
        $json = $this->get('search', [
            'q' => $query,
            'type' => 'artist',
            'market' => $this->market,
            'limit' => $limit,
            'offset' => $offset,
        ]);

        return $json->artists;
    }
}
